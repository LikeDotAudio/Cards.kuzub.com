<?php
header('Content-Type: application/json');

// db_config.php is generated at deploy time from GitHub secrets (not in the repo)
$config = require __DIR__ . '/db_config.php';
$host = $config['host'];
$db   = $config['name'];
$user = $config['user'];
$pass = $config['pass'];
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}

// Create tables on first run
$pdo->exec("
    CREATE TABLE IF NOT EXISTS cards (
        id INT AUTO_INCREMENT PRIMARY KEY,
        set_name VARCHAR(100) NOT NULL,
        card_number VARCHAR(20) NOT NULL,
        player_name VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
");
$pdo->exec("
    CREATE TABLE IF NOT EXISTS user_collection (
        card_id INT PRIMARY KEY,
        quantity TINYINT NOT NULL DEFAULT 0,
        last_checked DATETIME NULL,
        FOREIGN KEY (card_id) REFERENCES cards(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
");
// collector_name is the public name shown on the site for trading
$pdo->exec("
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        initials VARCHAR(5) NOT NULL,
        collector_name VARCHAR(50) NOT NULL UNIQUE,
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
");

$hasSortOrder = $pdo->query("SHOW COLUMNS FROM cards LIKE 'sort_order'")->fetch();
if (!$hasSortOrder) {
    $pdo->exec("ALTER TABLE cards ADD COLUMN sort_order INT NOT NULL DEFAULT 0");
}

$action = $_GET['action'] ?? '';

// GET CARDS (Includes auto-seed if table is empty)
if ($action === 'get_cards') {
    $checklist = require __DIR__ . '/checklist.php';
    $count = $pdo->query("SELECT COUNT(*) FROM cards")->fetchColumn();
    $unsorted = $pdo->query("SELECT COUNT(*) FROM cards WHERE sort_order = 0")->fetchColumn();
    if ($count != count($checklist) || $unsorted > 0) {
        syncCards($pdo, $checklist);
    }

    $stmt = $pdo->query("
        SELECT 
            c.id, c.set_name, c.card_number, c.player_name,
            COALESCE(u.quantity, 0) AS quantity,
            u.last_checked
        FROM cards c
        LEFT JOIN user_collection u ON c.id = u.card_id
        ORDER BY c.sort_order, c.id ASC
    ");
    echo json_encode($stmt->fetchAll());
    exit;
}

// TOGGLE QUANTITY: 0 -> 1 -> 2 (Double) -> 0
if ($action === 'toggle_card' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $cardId = $input['card_id'] ?? null;

    if (!$cardId) {
        echo json_encode(['error' => 'Invalid Card ID']);
        exit;
    }

    // Get current quantity
    $stmt = $pdo->prepare("SELECT quantity FROM user_collection WHERE card_id = ?");
    $stmt->execute([$cardId]);
    $current = $stmt->fetchColumn();

    $newQty = 0;
    $dateChecked = null;

    if ($current === false || $current == 0) {
        $newQty = 1;
        $dateChecked = date('Y-m-d H:i:s');
    } elseif ($current == 1) {
        $newQty = 2; // Marked as duplicate/double
        $dateChecked = date('Y-m-d H:i:s');
    } else {
        $newQty = 0; // Cleared / Removed
        $dateChecked = null;
    }

    $stmt = $pdo->prepare("
        INSERT INTO user_collection (card_id, quantity, last_checked) 
        VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE quantity = VALUES(quantity), last_checked = VALUES(last_checked)
    ");
    $stmt->execute([$cardId, $newQty, $dateChecked]);

    echo json_encode(['success' => true, 'quantity' => $newQty, 'last_checked' => $dateChecked]);
    exit;
}

// SYNC CHECKLIST: insert missing cards, fix names and ordering of existing ones.
// Numbered cards match on set + number; unnumbered ones match on set + player.
// Existing rows keep their ids, so collection status is preserved.
function syncCards($pdo, $checklist) {
    $findNumbered = $pdo->prepare("SELECT id FROM cards WHERE set_name = ? AND card_number = ?");
    $findUnnumbered = $pdo->prepare("SELECT id FROM cards WHERE set_name = ? AND card_number = '' AND player_name = ?");
    $update = $pdo->prepare("UPDATE cards SET player_name = ?, sort_order = ? WHERE id = ?");
    $insert = $pdo->prepare("INSERT INTO cards (set_name, card_number, player_name, sort_order) VALUES (?, ?, ?, ?)");

    $pdo->beginTransaction();
    foreach ($checklist as $i => [$set, $number, $player]) {
        $order = $i + 1;
        if ($number !== '') {
            $findNumbered->execute([$set, $number]);
            $id = $findNumbered->fetchColumn();
        } else {
            $findUnnumbered->execute([$set, $player]);
            $id = $findUnnumbered->fetchColumn();
        }
        if ($id) {
            $update->execute([$player, $order, $id]);
        } else {
            $insert->execute([$set, $number, $player, $order]);
        }
    }
    $pdo->commit();
}
