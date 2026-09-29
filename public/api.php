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

$action = $_GET['action'] ?? '';

// GET CARDS (Includes auto-seed if table is empty)
if ($action === 'get_cards') {
    $count = $pdo->query("SELECT COUNT(*) FROM cards")->fetchColumn();
    if ($count == 0) {
        seedCards($pdo);
    }

    $stmt = $pdo->query("
        SELECT 
            c.id, c.set_name, c.card_number, c.player_name,
            COALESCE(u.quantity, 0) AS quantity,
            u.last_checked
        FROM cards c
        LEFT JOIN user_collection u ON c.id = u.card_id
        ORDER BY c.set_name, c.id ASC
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

// SEEDER FUNCTION (Populates the 2026-27 Checklist)
function seedCards($pdo) {
    $cards = [
        // Base Checklist (sample shown, add full 120 as desired)
        ['Base', '1', 'Tim Horton'], ['Base', '2', 'Evan Bouchard'], ['Base', '3', 'Leo Carlsson'],
        ['Base', '4', 'Miro Heiskanen'], ['Base', '5', 'Andrei Vasilevskiy'], ['Base', '6', 'Brock Boeser'],
        ['Base', '7', 'Brady Tkachuk'], ['Base', '8', 'Jordan Kyrou'], ['Base', '9', 'Jack Eichel'],
        ['Base', '10', 'Zach Werenski'], ['Base', '34', 'Auston Matthews'], ['Base', '87', 'Sidney Crosby'],
        ['Base', '97', 'Connor McDavid'], ['Base', '98', 'Connor Bedard'], ['Base', '100', 'Leon Draisaitl'],

        // Above the Ice
        ['Above the Ice', 'AI-1', 'Dustin Wolf'], ['Above the Ice', 'AI-2', 'Leon Draisaitl'],
        ['Above the Ice', 'AI-3', 'Lane Hutson'], ['Above the Ice', 'AI-10', 'Macklin Celebrini'],

        // Attack Angle
        ['Attack Angle', 'AA-1', 'Tim Stützle'], ['Attack Angle', 'AA-17', 'Sidney Crosby'],
        ['Attack Angle', 'AA-18', 'Connor Bedard'],

        // First Liners
        ['First Liners', 'FL-1', 'Shea Theodore'], ['First Liners', 'FL-17', 'Sidney Crosby'],
        ['First Liners', 'FL-18', 'Nathan MacKinnon'],

        // Next Gen Phenoms
        ['Next Gen Phenoms', 'NG-1', 'Connor Bedard'], ['Next Gen Phenoms', 'NG-2', 'Macklin Celebrini'],
        ['Next Gen Phenoms', 'NG-3', 'Matthew Schaefer'], ['Next Gen Phenoms', 'NG-4', 'Ivan Demidov'],

        // Powerhouse Pillars
        ['Powerhouse Pillars', 'PO-1', 'Connor McDavid'], ['Powerhouse Pillars', 'PO-2', 'Sidney Crosby'],

        // Sidekicks
        ['Sidekicks', 'SK-1', 'Nathan MacKinnon / Cale Makar'], ['Sidekicks', 'SK-6', 'Connor McDavid / Leon Draisaitl'],
        ['Sidekicks', 'SK-9', 'Nick Suzuki / Cole Caufield']
    ];

    $stmt = $pdo->prepare("INSERT INTO cards (set_name, card_number, player_name) VALUES (?, ?, ?)");
    foreach ($cards as $c) {
        $stmt->execute($c);
    }
}
