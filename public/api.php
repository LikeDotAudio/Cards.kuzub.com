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

// Per-collector collection (replaces the single shared user_collection table)
$pdo->exec("
    CREATE TABLE IF NOT EXISTS collections (
        user_id INT NOT NULL,
        card_id INT NOT NULL,
        quantity TINYINT NOT NULL DEFAULT 0,
        last_checked DATETIME NULL,
        PRIMARY KEY (user_id, card_id),
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (card_id) REFERENCES cards(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
");

$action = $_GET['action'] ?? '';
$input = json_decode(file_get_contents('php://input'), true) ?? [];

function fail($message, $code = 400) {
    http_response_code($code);
    echo json_encode(['error' => $message]);
    exit;
}

// Initials are each collector's secret: they are only ever checked, never returned
function checkInitials($pdo, $userId, $initials) {
    $stmt = $pdo->prepare("SELECT initials FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $stored = $stmt->fetchColumn();
    return $stored !== false && hash_equals($stored, strtoupper(trim((string) $initials)));
}

// LIST COLLECTORS
if ($action === 'get_users') {
    $stmt = $pdo->query("SELECT id, collector_name FROM users ORDER BY collector_name");
    echo json_encode($stmt->fetchAll());
    exit;
}

// CREATE COLLECTOR
if ($action === 'create_user' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $initials = strtoupper(trim($input['initials'] ?? ''));
    $name = trim($input['collector_name'] ?? '');

    if (!preg_match('/^[A-Z]{1,5}$/', $initials)) {
        fail('Initials must be 1-5 letters');
    }
    if (mb_strlen($name) < 2 || mb_strlen($name) > 50) {
        fail('Collector name must be 2-50 characters');
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO users (initials, collector_name) VALUES (?, ?)");
        $stmt->execute([$initials, $name]);
    } catch (\PDOException $e) {
        if ($e->getCode() === '23000') {
            fail('That collector name is taken');
        }
        throw $e;
    }
    $userId = (int) $pdo->lastInsertId();

    // The first collector inherits anything marked before collectors existed
    if ($pdo->query("SELECT COUNT(*) FROM users")->fetchColumn() == 1) {
        $stmt = $pdo->prepare("
            INSERT IGNORE INTO collections (user_id, card_id, quantity, last_checked)
            SELECT ?, card_id, quantity, last_checked FROM user_collection WHERE quantity > 0
        ");
        $stmt->execute([$userId]);
    }

    echo json_encode(['id' => $userId, 'collector_name' => $name]);
    exit;
}

// SIGN IN: check a collector's initials
if ($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!checkInitials($pdo, (int) ($input['user_id'] ?? 0), $input['initials'] ?? '')) {
        fail('Wrong collector or initials', 403);
    }
    echo json_encode(['success' => true]);
    exit;
}

// GET CARDS for a collector, with the other collectors holding doubles of each card.
// Collections are public: any collector can view another's (read-only in the UI).
if ($action === 'get_cards') {
    $checklist = require __DIR__ . '/checklist.php';
    $count = $pdo->query("SELECT COUNT(*) FROM cards")->fetchColumn();
    $unsorted = $pdo->query("SELECT COUNT(*) FROM cards WHERE sort_order = 0")->fetchColumn();
    if ($count != count($checklist) || $unsorted > 0) {
        syncCards($pdo, $checklist);
    }

    // user_id: whose collection is shown; me: the collector doing the viewing
    $userId = (int) ($_GET['user_id'] ?? 0);
    $me = (int) ($_GET['me'] ?? $userId);
    $stmt = $pdo->prepare("
        SELECT
            c.id, c.set_name, c.card_number, c.player_name,
            COALESCE(mine.quantity, 0) AS quantity,
            mine.last_checked,
            COALESCE(viewer.quantity, 0) AS my_quantity,
            (
                SELECT GROUP_CONCAT(u.collector_name ORDER BY u.collector_name SEPARATOR '\n')
                FROM collections d
                JOIN users u ON u.id = d.user_id
                WHERE d.card_id = c.id AND d.quantity >= 2 AND d.user_id <> ?
            ) AS doubles_by
        FROM cards c
        LEFT JOIN collections mine ON mine.card_id = c.id AND mine.user_id = ?
        LEFT JOIN collections viewer ON viewer.card_id = c.id AND viewer.user_id = ?
        ORDER BY c.sort_order, c.id ASC
    ");
    $stmt->execute([$userId, $userId, $me]);
    $cards = $stmt->fetchAll();
    foreach ($cards as &$card) {
        $card['doubles_by'] = $card['doubles_by'] === null ? [] : explode("\n", $card['doubles_by']);
    }
    echo json_encode($cards);
    exit;
}

// TOGGLE QUANTITY: 0 -> 1 -> 2 (Double) -> 0
if ($action === 'toggle_card' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = (int) ($input['user_id'] ?? 0);
    $cardId = (int) ($input['card_id'] ?? 0);

    if (!$cardId) {
        fail('Invalid Card ID');
    }
    if (!checkInitials($pdo, $userId, $input['initials'] ?? '')) {
        fail('Sign in first', 403);
    }

    $stmt = $pdo->prepare("SELECT quantity FROM collections WHERE user_id = ? AND card_id = ?");
    $stmt->execute([$userId, $cardId]);
    $current = $stmt->fetchColumn();

    if ($current === false || $current == 0) {
        $newQty = 1;
    } elseif ($current == 1) {
        $newQty = 2; // Marked as duplicate/double
    } else {
        $newQty = 0; // Cleared / Removed
    }
    $dateChecked = $newQty > 0 ? date('Y-m-d H:i:s') : null;

    $stmt = $pdo->prepare("
        INSERT INTO collections (user_id, card_id, quantity, last_checked)
        VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE quantity = VALUES(quantity), last_checked = VALUES(last_checked)
    ");
    $stmt->execute([$userId, $cardId, $newQty, $dateChecked]);

    echo json_encode(['success' => true, 'quantity' => $newQty, 'last_checked' => $dateChecked]);
    exit;
}

fail('Unknown action');

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
