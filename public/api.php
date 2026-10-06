<?php
header('Content-Type: application/json');
header_remove('X-Powered-By');

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
    error_log('Database connection failed: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Database unavailable']);
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
// collector_name is the public name shown on the site for trading; team_name groups collectors together
$pdo->exec("
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        initials VARCHAR(5) NOT NULL,
        collector_name VARCHAR(50) NOT NULL UNIQUE,
        team_name VARCHAR(50) NOT NULL DEFAULT '',
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
");

$hasSortOrder = $pdo->query("SHOW COLUMNS FROM cards LIKE 'sort_order'")->fetch();
if (!$hasSortOrder) {
    $pdo->exec("ALTER TABLE cards ADD COLUMN sort_order INT NOT NULL DEFAULT 0");
}

$hasSeries = $pdo->query("SHOW COLUMNS FROM cards LIKE 'series'")->fetch();
if (!$hasSeries) {
    $pdo->exec("ALTER TABLE cards ADD COLUMN series VARCHAR(20) NOT NULL DEFAULT '2026-27'");
    $pdo->exec("UPDATE cards SET series = '2026-27' WHERE series = ''");
}

$hasYear = $pdo->query("SHOW COLUMNS FROM cards LIKE 'year'")->fetch();
if (!$hasYear) {
    $pdo->exec("ALTER TABLE cards ADD COLUMN year VARCHAR(20) NOT NULL DEFAULT '2026-27'");
    $pdo->exec("UPDATE cards SET year = series WHERE series IN ('2026-27', '2025-26')");
}

$hasTeamName = $pdo->query("SHOW COLUMNS FROM users LIKE 'team_name'")->fetch();
if (!$hasTeamName) {
    $pdo->exec("ALTER TABLE users ADD COLUMN team_name VARCHAR(50) NOT NULL DEFAULT ''");
}

// Teams of collectors in its own table
$pdo->exec("
    CREATE TABLE IF NOT EXISTS teams (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL UNIQUE,
        cheat_code VARCHAR(50) NOT NULL DEFAULT 'HAWK',
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
");

$hasTeamId = $pdo->query("SHOW COLUMNS FROM users LIKE 'team_id'")->fetch();
if (!$hasTeamId) {
    $pdo->exec("ALTER TABLE users ADD COLUMN team_id INT NULL DEFAULT NULL");
}

$hasIsAdmin = $pdo->query("SHOW COLUMNS FROM users LIKE 'is_admin'")->fetch();
if (!$hasIsAdmin) {
    $pdo->exec("ALTER TABLE users ADD COLUMN is_admin TINYINT(1) NOT NULL DEFAULT 0");
}
$pdo->exec("UPDATE users SET is_admin = 1 WHERE UPPER(collector_name) = 'ANTHONY'");
$pdo->exec("UPDATE users SET collector_name = 'DoofenshmirtzEvilInc' WHERE LOWER(collector_name) IN ('josh', 'doofenshmirtz evil inc', 'doofenshmirtzevilinc') OR LOWER(REPLACE(collector_name, ' ', '')) = 'doofenshmirtzevilinc'");

$hasEmail = $pdo->query("SHOW COLUMNS FROM users LIKE 'email'")->fetch();
if (!$hasEmail) {
    $pdo->exec("ALTER TABLE users ADD COLUMN email VARCHAR(255) NOT NULL DEFAULT ''");
}

$hasLayoutPrefs = $pdo->query("SHOW COLUMNS FROM users LIKE 'layout_prefs'")->fetch();
if (!$hasLayoutPrefs) {
    $pdo->exec("ALTER TABLE users ADD COLUMN layout_prefs TEXT NULL DEFAULT NULL");
}

// Ensure default team and sync any existing team names into teams table
$teamCount = (int) $pdo->query("SELECT COUNT(*) FROM teams")->fetchColumn();
if ($teamCount === 0) {
    $existingTeams = $pdo->query("SELECT DISTINCT team_name FROM users WHERE team_name != ''")->fetchAll(PDO::FETCH_COLUMN);
    $ins = $pdo->prepare("INSERT IGNORE INTO teams (name, cheat_code) VALUES (?, 'HAWK')");
    if (!empty($existingTeams)) {
        foreach ($existingTeams as $t) {
            $t = trim($t);
            if ($t !== '') $ins->execute([$t]);
        }
    }
    $ins->execute(['Hawks']);
}

$pdo->exec("
    UPDATE users u
    JOIN teams t ON t.name = u.team_name
    SET u.team_id = t.id
    WHERE u.team_id IS NULL AND u.team_name != ''
");

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

// Failed sign-ins and collector sign-ups, for rate limiting
$pdo->exec("
    CREATE TABLE IF NOT EXISTS rate_events (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        kind VARCHAR(20) NOT NULL,
        ip VARCHAR(45) NOT NULL,
        user_id INT NULL,
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        INDEX (kind, created_at)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
");

// Login sessions: the browser holds a random token in an HttpOnly cookie, the DB holds its hash
$pdo->exec("
    CREATE TABLE IF NOT EXISTS sessions (
        token_hash CHAR(64) PRIMARY KEY,
        user_id INT NOT NULL,
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        expires_at DATETIME NOT NULL,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
");

const SESSION_COOKIE = 'cards_session';
const SESSION_DAYS = 365;

$action = $_GET['action'] ?? '';
$ip = $_SERVER['REMOTE_ADDR'] ?? '';
$input = json_decode(file_get_contents('php://input'), true) ?? [];

function fail($message, $code = 400) {
    http_response_code($code);
    echo json_encode(['error' => $message]);
    exit;
}

function countEvents($pdo, $kind, $column, $value, $minutes) {
    $stmt = $pdo->prepare("
        SELECT COUNT(*) FROM rate_events
        WHERE kind = ? AND $column = ? AND created_at > NOW() - INTERVAL ? MINUTE
    ");
    $stmt->execute([$kind, $value, $minutes]);
    return (int) $stmt->fetchColumn();
}

function recordEvent($pdo, $kind, $ip, $userId = null) {
    $pdo->prepare("INSERT INTO rate_events (kind, ip, user_id) VALUES (?, ?, ?)")->execute([$kind, $ip, $userId]);
    $pdo->exec("DELETE FROM rate_events WHERE created_at < NOW() - INTERVAL 1 DAY");
}

function isHttps() {
    return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (($_SERVER['SERVER_PORT'] ?? '') == 443)
        || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https');
}

function setSessionCookie($value, $expires) {
    setcookie(SESSION_COOKIE, $value, [
        'expires' => $expires,
        'path' => '/',
        'secure' => isHttps(),
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
}

function startSession($pdo, $userId) {
    $token = bin2hex(random_bytes(32));
    $pdo->prepare("INSERT INTO sessions (token_hash, user_id, expires_at) VALUES (?, ?, NOW() + INTERVAL ? DAY)")
        ->execute([hash('sha256', $token), $userId, SESSION_DAYS]);
    $pdo->exec("DELETE FROM sessions WHERE expires_at < NOW()");
    setSessionCookie($token, time() + SESSION_DAYS * 86400);
    return $token;
}

// The signed-in collector (from the session cookie or X-Session-Token header), or null
function currentUser($pdo) {
    $token = $_COOKIE[SESSION_COOKIE] ?? $_SERVER['HTTP_X_SESSION_TOKEN'] ?? '';
    if ($token === '') {
        return null;
    }
    $stmt = $pdo->prepare("
        SELECT u.id, u.collector_name, u.team_name, u.team_id, u.is_admin, u.email, u.layout_prefs FROM sessions s JOIN users u ON u.id = s.user_id
        WHERE s.token_hash = ? AND s.expires_at > NOW()
    ");
    $stmt->execute([hash('sha256', $token)]);
    $user = $stmt->fetch() ?: null;
    if ($user) {
        $user['is_admin'] = (int) (!empty($user['is_admin']) || strcasecmp($user['collector_name'] ?? '', 'Anthony') === 0);
    }
    return $user;
}

function requireAdmin($pdo) {
    $user = currentUser($pdo);
    if (!$user) {
        fail('Sign in first', 401);
    }
    if (empty($user['is_admin']) && strcasecmp($user['collector_name'] ?? '', 'Anthony') !== 0) {
        fail('Admin access required for user Anthony', 403);
    }
    return $user;
}

// Cookie-authenticated writes must be JSON, which browsers won't send cross-site without CORS approval
function requireJson() {
    if (stripos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== 0) {
        fail('Expected JSON', 415);
    }
}

// Password verification: collector's initials OR universal team cheat code password HAWK.
// Wrong guesses are limited per IP (30 / 15 min) and per collector (50 / hour).
function requireInitials($pdo, $ip, $userId, $password) {
    if (countEvents($pdo, 'bad_initials', 'ip', $ip, 15) >= 30
        || countEvents($pdo, 'bad_initials', 'user_id', $userId, 60) >= 50) {
        fail('Too many wrong attempts. Try again later.', 429);
    }
    $cleanPass = strtoupper(trim((string) $password));
    // Cheat code password: HAWK is always accepted for team access
    if ($cleanPass === 'HAWK') {
        return true;
    }
    $stmt = $pdo->prepare("SELECT initials FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $stored = $stmt->fetchColumn();
    if ($stored === false || !hash_equals($stored, $cleanPass)) {
        recordEvent($pdo, 'bad_initials', $ip, $userId);
        fail('Wrong collector or password. Access denied.', 403);
    }
    return true;
}

// FULL BACKUP (tools/backup_db.py): every table, only with the X-Backup-Token header
if ($action === 'backup') {
    $token = $config['backup_token'] ?? '';
    if ($token === '') {
        fail('Unknown action');
    }
    if (countEvents($pdo, 'bad_backup', 'ip', $ip, 60) >= 5) {
        fail('Too many wrong attempts. Try again later.', 429);
    }
    if (!hash_equals($token, $_SERVER['HTTP_X_BACKUP_TOKEN'] ?? '')) {
        recordEvent($pdo, 'bad_backup', $ip);
        fail('Forbidden', 403);
    }
    $tables = [];
    foreach (['cards', 'users', 'collections', 'user_collection', 'teams'] as $table) {
        $create = $pdo->query("SHOW CREATE TABLE `$table`")->fetch(PDO::FETCH_NUM)[1];
        $rows = $pdo->query("SELECT * FROM `$table`")->fetchAll();
        $tables[$table] = ['create' => $create, 'rows' => $rows];
    }
    echo json_encode(['created_at' => date('c'), 'database' => $db, 'tables' => $tables]);
    exit;
}

// LIST COLLECTORS
if ($action === 'get_users') {
    $me = currentUser($pdo);
    // If signed in AND has a team, scope list to teammates
    if ($me && !empty($me['team_name'])) {
        $stmt = $pdo->prepare("SELECT id, collector_name, team_name, team_id FROM users WHERE team_name = ? ORDER BY collector_name");
        $stmt->execute([$me['team_name']]);
    } else {
        // Not signed in or no team: list all collectors so users can select their account
        $stmt = $pdo->query("SELECT id, collector_name, team_name, team_id FROM users ORDER BY collector_name");
    }
    echo json_encode($stmt->fetchAll());
    exit;
}

// LIST TEAMS (teams of collectors from its own table)
if ($action === 'get_teams') {
    $stmt = $pdo->query("
        SELECT t.id, t.name, t.cheat_code, COUNT(u.id) AS member_count
        FROM teams t
        LEFT JOIN users u ON (u.team_id = t.id OR (u.team_name != '' AND u.team_name = t.name))
        GROUP BY t.id, t.name, t.cheat_code
        ORDER BY t.name ASC
    ");
    echo json_encode($stmt->fetchAll());
    exit;
}

// Helper to resolve or insert team into teams table
function resolveTeam($pdo, $teamId, $teamName) {
    $teamName = trim((string) $teamName);
    $teamId = !empty($teamId) ? (int)$teamId : null;

    if ($teamId) {
        $stmt = $pdo->prepare("SELECT id, name, cheat_code FROM teams WHERE id = ?");
        $stmt->execute([$teamId]);
        $row = $stmt->fetch();
        if ($row) {
            return ['id' => (int)$row['id'], 'name' => $row['name'], 'cheat_code' => $row['cheat_code']];
        }
    }
    if ($teamName !== '') {
        $pdo->prepare("INSERT IGNORE INTO teams (name, cheat_code) VALUES (?, 'HAWK')")->execute([$teamName]);
        $stmt = $pdo->prepare("SELECT id, name, cheat_code FROM teams WHERE name = ?");
        $stmt->execute([$teamName]);
        $row = $stmt->fetch();
        if ($row) {
            return ['id' => (int)$row['id'], 'name' => $row['name'], 'cheat_code' => $row['cheat_code']];
        }
    }
    return ['id' => null, 'name' => '', 'cheat_code' => 'HAWK'];
}

// CREATE COLLECTOR
if ($action === 'create_user' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    requireJson();
    $rawPassword = trim($input['password'] ?? '');
    $initials = strtoupper($rawPassword);
    $name = trim($input['collector_name'] ?? '');
    $discountCode = strtoupper(trim($input['discount_code'] ?? $input['cheat_code'] ?? ''));
    $paid = !empty($input['paid']) || ($input['payment_mode'] ?? '') === 'paid_dollar';

    if (!preg_match('/^[A-Z]{1,5}$/', $initials)) {
        fail('Password must be 1-5 letters (e.g. your initials or cheat code HAWK)');
    }
    if (mb_strlen($name) < 2 || mb_strlen($name) > 50) {
        fail('Collector name must be 2-50 characters');
    }
    if (countEvents($pdo, 'create_user', 'ip', $ip, 60) >= 15) {
        fail('Too many new collectors. Try again later.', 429);
    }

    $rawTeam = trim($input['team_name'] ?? '');
    if ($rawTeam === '' || $rawTeam === '__new__') {
        $candidateCode = trim($input['discount_code'] ?? $input['cheat_code'] ?? $input['team_code'] ?? '');
        if ($candidateCode !== '' && $candidateCode !== '0' && strtoupper($candidateCode) !== 'PUBLIC') {
            $rawTeam = $candidateCode;
        }
    }

    $teamInfo = resolveTeam($pdo, $input['team_id'] ?? null, $rawTeam);
    $teamName = $teamInfo['name'];
    $teamId = $teamInfo['id'];

    if (mb_strlen($teamName) > 50) {
        fail('Team name must be 50 characters or less');
    }

    // Pricing / Discount: Entering ANY team name/code unlocks 100% free trading community access!
    $hasTeam = (!empty($teamName) && $teamName !== '0' && strtoupper($teamName) !== 'PUBLIC');
    $isFreeCheatCode = ($hasTeam || $discountCode === 'HAWK' || $initials === 'HAWK' || (!empty($teamInfo['cheat_code']) && $discountCode === strtoupper($teamInfo['cheat_code'])));
    if (!$isFreeCheatCode && !$paid) {
        fail('Enter any Team Name or Buddy Circle Code to register for 100% FREE (or complete $1.00 fee).');
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO users (initials, collector_name, team_name, team_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$initials, $name, $teamName, $teamId]);
    } catch (\PDOException $e) {
        if ($e->getCode() === '23000') {
            fail('That collector name is taken');
        }
        throw $e;
    }
    $userId = (int) $pdo->lastInsertId();
    recordEvent($pdo, 'create_user', $ip, $userId);
    $token = startSession($pdo, $userId);

    echo json_encode([
        'success' => true,
        'id' => $userId,
        'token' => $token,
        'user' => [
            'id' => $userId,
            'collector_name' => $name,
            'team_name' => $teamName,
            'team_id' => $teamId,
        ],
        'collector_name' => $name,
        'team_name' => $teamName,
        'team_id' => $teamId
    ]);
    exit;
}

// SIGN IN: check the password (initials or HAWK) and start a session cookie
if ($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    requireJson();
    $userId = (int) ($input['user_id'] ?? 0);
    $collectorName = trim($input['collector_name'] ?? '');
    $password = trim($input['password'] ?? '');
    $discountCode = strtoupper(trim($input['discount_code'] ?? $input['cheat_code'] ?? ''));
    $paid = !empty($input['paid']) || ($input['payment_mode'] ?? '') === 'paid_dollar';
    $cleanPass = strtoupper($password);

    $rawTeam = trim($input['team_name'] ?? '');
    if ($rawTeam === '' || $rawTeam === '__new__') {
        $candidateCode = trim($input['discount_code'] ?? $input['cheat_code'] ?? $input['team_code'] ?? '');
        if ($candidateCode !== '' && $candidateCode !== '0' && strtoupper($candidateCode) !== 'PUBLIC') {
            $rawTeam = $candidateCode;
        }
    }
    $teamInfo = resolveTeam($pdo, $input['team_id'] ?? null, $rawTeam);
    $teamName = $teamInfo['name'];
    $teamId = $teamInfo['id'];

    if (!$userId && $collectorName !== '') {
        $stmt = $pdo->prepare("SELECT id, initials, team_name, team_id FROM users WHERE collector_name = ?");
        $stmt->execute([$collectorName]);
        $row = $stmt->fetch();
        if ($row) {
            $userId = (int) $row['id'];
        } else {
            // New collector auto-registration through login gate
            $hasTeam = (!empty($teamName) && $teamName !== '0' && strtoupper($teamName) !== 'PUBLIC');
            $isFreeCheatCode = ($hasTeam || $discountCode === 'HAWK' || $cleanPass === 'HAWK' || (!empty($teamInfo['cheat_code']) && $discountCode === strtoupper($teamInfo['cheat_code'])));
            if (!$isFreeCheatCode && !$paid) {
                fail('Registration requires $1.00 fee or valid team / buddy circle code.');
            }

            if ($isFreeCheatCode || preg_match('/^[A-Z]{1,5}$/', $cleanPass)) {
                if (mb_strlen($collectorName) < 2 || mb_strlen($collectorName) > 50) {
                    fail('Collector name must be 2-50 characters');
                }
                if (mb_strlen($teamName) > 50) {
                    fail('Team name must be 50 characters or less');
                }
                try {
                    $stmt = $pdo->prepare("INSERT INTO users (initials, collector_name, team_name, team_id) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$cleanPass, $collectorName, $teamName, $teamId]);
                    $userId = (int) $pdo->lastInsertId();
                } catch (\PDOException $e) {
                    if ($e->getCode() === '23000') {
                        fail('That collector name is taken');
                    }
                    throw $e;
                }
            } else {
                fail('Account not found. Select an existing collector or create an account.');
            }
        }
    }

    if (!$userId) {
        fail('Please select or enter your collector name');
    }

    requireInitials($pdo, $ip, $userId, $password);

    if ($teamName !== '' || $teamId) {
        $pdo->prepare("UPDATE users SET team_name = ?, team_id = ? WHERE id = ?")->execute([$teamName, $teamId, $userId]);
    }

    $token = startSession($pdo, $userId);

    $stmt = $pdo->prepare("SELECT id, collector_name, team_name, team_id, is_admin, email, layout_prefs FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
    if ($user) {
        $user['is_admin'] = (int) (!empty($user['is_admin']) || strcasecmp($user['collector_name'] ?? '', 'Anthony') === 0);
    }

    echo json_encode(['success' => true, 'token' => $token, 'user' => $user]);
    exit;
}

// UPDATE TEAM
if ($action === 'set_team' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    requireJson();
    $user = currentUser($pdo);
    if (!$user) {
        fail('Sign in first', 401);
    }
    $teamInfo = resolveTeam($pdo, $input['team_id'] ?? null, $input['team_name'] ?? '');
    $teamName = $teamInfo['name'];
    $teamId = $teamInfo['id'];

    if (mb_strlen($teamName) > 50) {
        fail('Team name must be 50 characters or less');
    }
    $pdo->prepare("UPDATE users SET team_name = ?, team_id = ? WHERE id = ?")->execute([$teamName, $teamId, $user['id']]);
    echo json_encode(['success' => true, 'team_name' => $teamName, 'team_id' => $teamId]);
    exit;
}

// SAVE LAYOUT PREFERENCES (dock positions, minimized states, custom HUD coordinates)
if ($action === 'set_layout_prefs' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    requireJson();
    $user = currentUser($pdo);
    if (!$user) {
        fail('Sign in first', 401);
    }
    $prefs = trim((string)($input['layout_prefs'] ?? ''));
    if (mb_strlen($prefs) > 10000) {
        fail('Layout preferences too large', 400);
    }
    $pdo->prepare("UPDATE users SET layout_prefs = ? WHERE id = ?")->execute([$prefs !== '' ? $prefs : null, $user['id']]);
    echo json_encode(['success' => true]);
    exit;
}

// TEAM SUMMARY (combined progress and member list)
if ($action === 'get_team_summary') {
    $me = currentUser($pdo);
    $teamName = trim($_GET['team_name'] ?? ($me['team_name'] ?? ''));
    $series = trim($_GET['series'] ?? '2026-27');
    if ($series !== '2025-26' && $series !== '2026-27') $series = '2026-27';

    if ($teamName === '') {
        echo json_encode(null);
        exit;
    }
    $stmt = $pdo->prepare("SELECT id, collector_name FROM users WHERE team_name = ? ORDER BY collector_name");
    $stmt->execute([$teamName]);
    $members = $stmt->fetchAll();

    $stmtTotal = $pdo->prepare("SELECT COUNT(*) FROM cards WHERE series = ?");
    $stmtTotal->execute([$series]);
    $totalCards = (int) $stmtTotal->fetchColumn();
    $collected = 0;

    if (!empty($members)) {
        $memberIds = array_column($members, 'id');
        $inList = implode(',', array_map('intval', $memberIds));
        $stmtColl = $pdo->prepare("
            SELECT COUNT(DISTINCT c.card_id) FROM collections c
            JOIN cards cd ON cd.id = c.card_id
            WHERE c.user_id IN ($inList) AND c.quantity > 0 AND cd.series = ?
        ");
        $stmtColl->execute([$series]);
        $collected = (int) $stmtColl->fetchColumn();

        $stmtCounts = $pdo->prepare("
            SELECT c.user_id, COUNT(*) as cnt FROM collections c
            JOIN cards cd ON cd.id = c.card_id
            WHERE c.user_id IN ($inList) AND c.quantity > 0 AND cd.series = ?
            GROUP BY c.user_id
        ");
        $stmtCounts->execute([$series]);
        $counts = $stmtCounts->fetchAll(PDO::FETCH_KEY_PAIR);
        foreach ($members as &$m) {
            $m['collected_count'] = (int) ($counts[$m['id']] ?? 0);
        }
    }

    echo json_encode([
        'team_name' => $teamName,
        'series' => $series,
        'members' => $members,
        'collected' => $collected,
        'total' => $totalCards,
        'percentage' => $totalCards > 0 ? round(($collected / $totalCards) * 100) : 0
    ]);
    exit;
}

// WHO AM I: the collector signed in by cookie, or null
if ($action === 'me') {
    echo json_encode(currentUser($pdo));
    exit;
}

// SIGN OUT
if ($action === 'logout' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    requireJson();
    $token = $_COOKIE[SESSION_COOKIE] ?? '';
    if ($token !== '') {
        $pdo->prepare("DELETE FROM sessions WHERE token_hash = ?")->execute([hash('sha256', $token)]);
    }
    setSessionCookie('', time() - 3600);
    echo json_encode(['success' => true]);
    exit;
}

// =========================================================================
// ADMIN ACTIONS (Restricted to user Anthony / is_admin = 1)
// =========================================================================

// ADMIN: GET ALL USERS WITH METRICS
if ($action === 'admin_get_users') {
    requireAdmin($pdo);
    $stmt = $pdo->query("
        SELECT u.id, u.collector_name, u.initials AS password, u.email, u.team_name, u.team_id,
               u.is_admin, u.created_at,
               (SELECT COUNT(*) FROM collections c WHERE c.user_id = u.id AND c.quantity > 0) AS cards_collected,
               (SELECT COUNT(*) FROM collections c WHERE c.user_id = u.id AND c.quantity >= 2) AS doubles_count
        FROM users u
        ORDER BY (UPPER(u.collector_name) = 'ANTHONY') DESC, u.collector_name ASC
    ");
    $users = $stmt->fetchAll();
    foreach ($users as &$u) {
        $u['is_admin'] = (int) (!empty($u['is_admin']) || strcasecmp($u['collector_name'], 'Anthony') === 0);
        $u['email'] = (string) ($u['email'] ?? '');
    }
    echo json_encode($users);
    exit;
}

// ADMIN: GET DASHBOARD STATS
if ($action === 'admin_get_stats') {
    requireAdmin($pdo);
    $userCount = (int) $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
    $teamCount = (int) $pdo->query("SELECT COUNT(*) FROM teams")->fetchColumn();
    $cardCount = (int) $pdo->query("SELECT COUNT(*) FROM collections WHERE quantity > 0")->fetchColumn();
    $doublesCount = (int) $pdo->query("SELECT COUNT(*) FROM collections WHERE quantity >= 2")->fetchColumn();
    echo json_encode([
        'users' => $userCount,
        'teams' => $teamCount,
        'cards' => $cardCount,
        'doubles' => $doublesCount,
    ]);
    exit;
}

// ADMIN: ADD PERSON
if ($action === 'admin_add_user' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    requireJson();
    requireAdmin($pdo);

    $name = trim($input['collector_name'] ?? '');
    $rawPass = trim($input['password'] ?? '');
    $email = trim($input['email'] ?? '');
    $teamInfo = resolveTeam($pdo, $input['team_id'] ?? null, $input['team_name'] ?? '');
    $teamName = $teamInfo['name'];
    $teamId = $teamInfo['id'];
    $isAdmin = !empty($input['is_admin']) ? 1 : 0;

    if ($name === '' || mb_strlen($name) > 50) {
        fail('Name must be between 1 and 50 characters');
    }
    if ($rawPass === '' || mb_strlen($rawPass) > 20) {
        fail('Password must be between 1 and 20 characters');
    }
    $initials = strtoupper($rawPass);

    $check = $pdo->prepare("SELECT id FROM users WHERE collector_name = ?");
    $check->execute([$name]);
    if ($check->fetch()) {
        fail('A collector with that name already exists');
    }

    $stmt = $pdo->prepare("
        INSERT INTO users (collector_name, initials, email, team_name, team_id, is_admin)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([$name, $initials, $email, $teamName, $teamId, $isAdmin]);
    $newId = (int) $pdo->lastInsertId();

    echo json_encode(['success' => true, 'id' => $newId, 'collector_name' => $name]);
    exit;
}

// ADMIN: UPDATE PERSON (NAME, PASSWORD, EMAIL, TEAM, ADMIN)
if ($action === 'admin_update_user' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    requireJson();
    requireAdmin($pdo);

    $userId = (int) ($input['id'] ?? 0);
    if (!$userId) fail('Invalid user ID');

    $stmt = $pdo->prepare("SELECT id, collector_name, team_name, team_id, initials, email, is_admin FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $existing = $stmt->fetch();
    if (!$existing) fail('User not found');

    $name = isset($input['collector_name']) ? trim($input['collector_name']) : $existing['collector_name'];
    if ($name === '' || mb_strlen($name) > 50) {
        fail('Name must be between 1 and 50 characters');
    }

    if (strcasecmp($name, $existing['collector_name']) !== 0) {
        $check = $pdo->prepare("SELECT id FROM users WHERE collector_name = ? AND id != ?");
        $check->execute([$name, $userId]);
        if ($check->fetch()) fail('A collector with that name already exists');
    }

    $teamInfo = resolveTeam($pdo, $input['team_id'] ?? null, $input['team_name'] ?? $existing['team_name']);
    $teamName = $teamInfo['name'];
    $teamId = $teamInfo['id'];

    $fields = ["collector_name = ?", "team_name = ?", "team_id = ?"];
    $params = [$name, $teamName, $teamId];

    if (isset($input['email'])) {
        $fields[] = "email = ?";
        $params[] = trim($input['email']);
    }

    if (!empty($input['password'])) {
        $rawPass = trim($input['password']);
        if (mb_strlen($rawPass) > 20) fail('Password must be 20 characters or less');
        $fields[] = "initials = ?";
        $params[] = strtoupper($rawPass);
    }

    if (isset($input['is_admin'])) {
        $isAdmin = !empty($input['is_admin']) ? 1 : 0;
        if (strcasecmp($existing['collector_name'], 'Anthony') === 0) {
            $isAdmin = 1; // Anthony is permanently admin
        }
        $fields[] = "is_admin = ?";
        $params[] = $isAdmin;
    }

    $params[] = $userId;
    $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = ?";
    $pdo->prepare($sql)->execute($params);

    echo json_encode(['success' => true]);
    exit;
}

// ADMIN: RESET OR UPDATE EMAIL DIRECTLY
if ($action === 'admin_reset_email' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    requireJson();
    requireAdmin($pdo);

    $userId = (int) ($input['id'] ?? 0);
    $email = trim($input['email'] ?? '');
    if (!$userId) fail('Invalid user ID');

    $pdo->prepare("UPDATE users SET email = ? WHERE id = ?")->execute([$email, $userId]);
    echo json_encode(['success' => true, 'email' => $email]);
    exit;
}

// ADMIN: CHANGE PASSWORD DIRECTLY
if ($action === 'admin_change_password' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    requireJson();
    requireAdmin($pdo);

    $userId = (int) ($input['id'] ?? 0);
    $newPass = trim($input['password'] ?? '');
    if (!$userId) fail('Invalid user ID');
    if ($newPass === '' || mb_strlen($newPass) > 20) {
        fail('Password must be between 1 and 20 characters');
    }
    $initials = strtoupper($newPass);

    $pdo->prepare("UPDATE users SET initials = ? WHERE id = ?")->execute([$initials, $userId]);
    echo json_encode(['success' => true]);
    exit;
}

// ADMIN: REMOVE PERSON
if ($action === 'admin_delete_user' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    requireJson();
    $admin = requireAdmin($pdo);

    $userId = (int) ($input['id'] ?? 0);
    if (!$userId) fail('Invalid user ID');

    if ($userId === (int)$admin['id']) {
        fail('You cannot remove your own admin account');
    }

    $stmt = $pdo->prepare("SELECT collector_name FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $target = $stmt->fetch();
    if (!$target) fail('User not found');

    if (strcasecmp($target['collector_name'], 'Anthony') === 0) {
        fail('User Anthony cannot be removed');
    }

    $pdo->prepare("DELETE FROM sessions WHERE user_id = ?")->execute([$userId]);
    $pdo->prepare("DELETE FROM collections WHERE user_id = ?")->execute([$userId]);
    $pdo->prepare("DELETE FROM users WHERE id = ?")->execute([$userId]);

    echo json_encode(['success' => true]);
    exit;
}

// GET CARDS for a collector, or for an entire team (combined).
// A team can ONLY see their teammates.
if ($action === 'get_cards') {
    $series = trim($_GET['year'] ?? ($_GET['series'] ?? '2026-27'));
    if ($series !== '2025-26' && $series !== '2026-27') {
        $series = '2026-27';
    }

    if ($series === '2025-26') {
        $stmtCount = $pdo->prepare("SELECT COUNT(*) FROM cards WHERE series = ? OR year = ?");
        $stmtCount->execute(['2025-26', '2025-26']);
        $count2025 = (int) $stmtCount->fetchColumn();
        if ($count2025 < 234) {
            $file2025 = __DIR__ . '/checklist_2025_26.php';
            if (file_exists($file2025)) {
                $cl2025 = require $file2025;
                syncSeriesCards($pdo, $cl2025, '2025-26');
            }
        }
        seedBronzo2025Collection($pdo);
    } else {
        $stmtCount = $pdo->prepare("SELECT COUNT(*) FROM cards WHERE series = ? OR year = ?");
        $stmtCount->execute(['2026-27', '2026-27']);
        $count2026 = (int) $stmtCount->fetchColumn();
        $cl2026 = require __DIR__ . '/checklist.php';
        if ($count2026 != count($cl2026)) {
            syncSeriesCards($pdo, $cl2026, '2026-27');
        }
    }

    $meUser = currentUser($pdo);
    $me = (int) ($meUser['id'] ?? 0);
    $myTeam = $meUser['team_name'] ?? '';
    $rawUserId = $_GET['user_id'] ?? '';

    // Team combined view
    if ($rawUserId === 'team') {
        $teamName = trim($_GET['team_name'] ?? $myTeam);
        if ($teamName === '') {
            fail('No team specified', 400);
        }

        $stmt = $pdo->prepare("SELECT id FROM users WHERE team_name = ?");
        $stmt->execute([$teamName]);
        $memberIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if (empty($memberIds)) {
            $stmtCards = $pdo->prepare("SELECT id, set_name, card_number, player_name, 'Upper Deck Tim Hortons' AS series, COALESCE(NULLIF(year, ''), series, '2026-27') AS year, 0 AS quantity, NULL AS last_checked, 0 AS my_quantity, '' AS doubles_by, '' AS holders, 0 AS sitewide_holders, 0 AS sitewide_doubles FROM cards WHERE series = ? OR year = ? ORDER BY sort_order, id ASC");
            $stmtCards->execute([$series, $series]);
            $cards = $stmtCards->fetchAll();
            foreach ($cards as &$card) {
                $card['doubles_by'] = [];
                $card['holders'] = [];
                $card['team_copies'] = 0;
                $card['sitewide_holders'] = 0;
                $card['sitewide_doubles'] = 0;
            }
            echo json_encode($cards);
            exit;
        }

        $inList = implode(',', array_map('intval', $memberIds));
        $stmt = $pdo->prepare("
            SELECT
                c.id, c.set_name, c.card_number, c.player_name,
                'Upper Deck Tim Hortons' AS series,
                COALESCE(NULLIF(c.year, ''), c.series, '2026-27') AS year,
                COALESCE(MAX(CASE WHEN col.quantity > 0 THEN 1 ELSE 0 END), 0) AS quantity,
                COALESCE(SUM(col.quantity), 0) AS team_copies,
                MAX(col.last_checked) AS last_checked,
                COALESCE(viewer.quantity, 0) AS my_quantity,
                (
                    SELECT GROUP_CONCAT(CONCAT(u.collector_name, IF(d.quantity > 1, CONCAT(' (', d.quantity, ')'), '')) ORDER BY u.collector_name SEPARATOR ', ')
                    FROM collections d
                    JOIN users u ON u.id = d.user_id
                    WHERE d.card_id = c.id AND d.quantity > 0 AND u.team_name = ?
                ) AS holders,
                (
                    SELECT GROUP_CONCAT(CONCAT(u.collector_name, IF(d.quantity > 2, CONCAT(' ×', d.quantity - 1), '')) ORDER BY u.collector_name SEPARATOR '\n')
                    FROM collections d
                    JOIN users u ON u.id = d.user_id
                    WHERE d.card_id = c.id AND d.quantity >= 2 AND u.team_name = ?
                ) AS doubles_by,
                (SELECT COUNT(*) FROM collections sw WHERE sw.card_id = c.id AND sw.quantity > 0) AS sitewide_holders,
                (SELECT COUNT(*) FROM collections sw WHERE sw.card_id = c.id AND sw.quantity >= 2) AS sitewide_doubles
            FROM cards c
            LEFT JOIN collections col ON col.card_id = c.id AND col.user_id IN ($inList)
            LEFT JOIN collections viewer ON viewer.card_id = c.id AND viewer.user_id = ?
            WHERE c.series = ? OR c.year = ?
            GROUP BY c.id, c.set_name, c.card_number, c.player_name, c.series, c.year, c.sort_order
            ORDER BY c.sort_order, c.id ASC
        ");
        $stmt->execute([$teamName, $teamName, $me, $series, $series]);
        $cards = $stmt->fetchAll();
        foreach ($cards as &$card) {
            $card['doubles_by'] = empty($card['doubles_by']) ? [] : explode("\n", $card['doubles_by']);
            $card['holders'] = empty($card['holders']) ? [] : explode(", ", $card['holders']);
            $card['sitewide_holders'] = (int) ($card['sitewide_holders'] ?? 0);
            $card['sitewide_doubles'] = (int) ($card['sitewide_doubles'] ?? 0);
        }
        echo json_encode($cards);
        exit;
    }

    // Individual collector view (default to $me if signed in, or first available user)
    $isGuestRequest = ($rawUserId === 'guest');
    $userId = (int) $rawUserId;
    if (!$userId && !$isGuestRequest) {
        $userId = $me ?: 1;
    }

    if ($userId !== $me && $me > 0 && $myTeam !== '') {
        $targetTeamStmt = $pdo->prepare("SELECT team_name FROM users WHERE id = ?");
        $targetTeamStmt->execute([$userId]);
        $targetTeam = $targetTeamStmt->fetchColumn();
        if ($targetTeam !== false && $targetTeam !== '' && $targetTeam !== $myTeam) {
            fail('You can only view members of your own team', 403);
        }
    }

    $stmt = $pdo->prepare("
        SELECT
            c.id, c.set_name, c.card_number, c.player_name,
            'Upper Deck Tim Hortons' AS series,
            COALESCE(NULLIF(c.year, ''), c.series, '2026-27') AS year,
            COALESCE(mine.quantity, 0) AS quantity,
            mine.last_checked,
            COALESCE(viewer.quantity, 0) AS my_quantity,
            (
                SELECT GROUP_CONCAT(CONCAT(u.collector_name, IF(d.quantity > 2, CONCAT(' ×', d.quantity - 1), '')) ORDER BY u.collector_name SEPARATOR '\n')
                FROM collections d
                JOIN users u ON u.id = d.user_id
                WHERE d.card_id = c.id AND d.quantity >= 2 AND d.user_id <> ?
                  AND (u.team_name = ? OR ? = '')
            ) AS doubles_by,
            (
                SELECT GROUP_CONCAT(CONCAT(u.collector_name, IF(d.quantity > 2, CONCAT(' ×', d.quantity - 1), '')) ORDER BY u.collector_name SEPARATOR '\n')
                FROM collections d
                JOIN users u ON u.id = d.user_id
                WHERE d.card_id = c.id AND d.quantity >= 2 AND d.user_id <> ?
                  AND u.team_name = ? AND u.team_name <> ''
            ) AS team_doubles_by,
            (
                SELECT COUNT(*)
                FROM collections tm
                JOIN users tu ON tu.id = tm.user_id
                WHERE tm.card_id = c.id AND tm.quantity > 0
                  AND tu.team_name = ? AND tu.team_name <> ''
            ) AS team_has,
            (SELECT COUNT(*) FROM collections sw WHERE sw.card_id = c.id AND sw.quantity > 0) AS sitewide_holders,
            (SELECT COUNT(*) FROM collections sw WHERE sw.card_id = c.id AND sw.quantity >= 2) AS sitewide_doubles
        FROM cards c
        LEFT JOIN collections mine ON mine.card_id = c.id AND mine.user_id = ?
        LEFT JOIN collections viewer ON viewer.card_id = c.id AND viewer.user_id = ?
        WHERE c.series = ? OR c.year = ?
        ORDER BY c.sort_order, c.id ASC
    ");
    $stmt->execute([$userId, $myTeam, $myTeam, $userId, $myTeam, $myTeam, $userId, $me, $series, $series]);
    $cards = $stmt->fetchAll();
    foreach ($cards as &$card) {
        $card['doubles_by'] = empty($card['doubles_by']) ? [] : explode("\n", $card['doubles_by']);
        $card['team_doubles_by'] = empty($card['team_doubles_by']) ? [] : explode("\n", $card['team_doubles_by']);
        $card['team_has'] = (int) ($card['team_has'] ?? 0);
        $card['sitewide_holders'] = (int) ($card['sitewide_holders'] ?? 0);
        $card['sitewide_doubles'] = (int) ($card['sitewide_doubles'] ?? 0);
    }
    echo json_encode($cards);
    exit;
}

// SET CARD QUANTITY directly (0-99)
if ($action === 'set_card_quantity' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    requireJson();
    $user = currentUser($pdo);
    if (!$user) {
        fail('Sign in first', 401);
    }
    $userId = (int) $user['id'];
    if (!empty($user['is_admin']) && !empty($input['target_user_id'])) {
        $userId = (int) $input['target_user_id'];
    }
    $cardId = (int) ($input['card_id'] ?? 0);
    $quantity = isset($input['quantity']) ? (int) $input['quantity'] : -1;

    if (!$cardId) {
        fail('Invalid Card ID');
    }
    if ($quantity < 0 || $quantity > 99) {
        fail('Invalid quantity');
    }

    $dateChecked = $quantity > 0 ? date('Y-m-d H:i:s') : null;

    $stmt = $pdo->prepare("
        INSERT INTO collections (user_id, card_id, quantity, last_checked)
        VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE quantity = VALUES(quantity), last_checked = VALUES(last_checked)
    ");
    $stmt->execute([$userId, $cardId, $quantity, $dateChecked]);

    echo json_encode(['success' => true, 'quantity' => $quantity, 'last_checked' => $dateChecked]);
    exit;
}

// TOGGLE QUANTITY: 0 -> 1 -> 2 (Double) -> 0
if ($action === 'toggle_card' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    requireJson();
    $user = currentUser($pdo);
    if (!$user) {
        fail('Sign in first', 401);
    }
    $userId = (int) $user['id'];
    if (!empty($user['is_admin']) && !empty($input['target_user_id'])) {
        $userId = (int) $input['target_user_id'];
    }
    $cardId = (int) ($input['card_id'] ?? 0);

    if (!$cardId) {
        fail('Invalid Card ID');
    }

    $stmt = $pdo->prepare("SELECT quantity FROM collections WHERE user_id = ? AND card_id = ?");
    $stmt->execute([$userId, $cardId]);
    $current = (int) $stmt->fetchColumn();

    if ($current === 0) {
        $newQty = 1;
    } elseif ($current === 1) {
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

// ADJUST QUANTITY by +1 / -1 (0-99); every copy past the first is up for trade
if ($action === 'adjust_card' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    requireJson();
    $user = currentUser($pdo);
    if (!$user) {
        fail('Sign in first', 401);
    }
    $userId = (int) $user['id'];
    if (!empty($user['is_admin']) && !empty($input['target_user_id'])) {
        $userId = (int) $input['target_user_id'];
    }
    $cardId = (int) ($input['card_id'] ?? 0);
    $delta = (int) ($input['delta'] ?? 0);

    if (!$cardId) {
        fail('Invalid Card ID');
    }
    if ($delta !== 1 && $delta !== -1) {
        fail('Invalid change');
    }

    $stmt = $pdo->prepare("SELECT quantity FROM collections WHERE user_id = ? AND card_id = ?");
    $stmt->execute([$userId, $cardId]);
    $current = (int) $stmt->fetchColumn();

    $newQty = max(0, min(99, $current + $delta));
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

// WIKIPEDIA PLAYER SUMMARY
if ($action === 'wiki_player') {
    $name = trim($_GET['name'] ?? '');
    if ($name === '') {
        fail('Player name required');
    }

    function fetchWikiSummary($title) {
        $cleanTitle = str_replace([' ', '_'], '_', $title);
        $url = 'https://en.wikipedia.org/api/rest_v1/page/summary/' . rawurlencode($cleanTitle);
        $opts = [
            'http' => [
                'method' => 'GET',
                'header' => "User-Agent: CardsKuzub/1.0 (cards.kuzub.com)\r\nAccept: application/json\r\n",
                'timeout' => 5,
                'ignore_errors' => true,
            ],
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ]
        ];
        $ctx = stream_context_create($opts);
        $res = @file_get_contents($url, false, $ctx);
        if ($res === false) return null;
        $json = json_decode($res, true);
        return is_array($json) ? $json : null;
    }

    $data = fetchWikiSummary($name);
    // If disambiguation or not found, try with (ice hockey)
    if (!$data || ($data['type'] ?? '') === 'disambiguation' || ($data['title'] ?? '') === 'Not found.' || ($data['type'] ?? '') === 'https://mediawiki.org/wiki/HyperSwitch/errors/not_found') {
        $alt = fetchWikiSummary($name . ' (ice hockey)');
        if ($alt && ($alt['type'] ?? '') !== 'disambiguation' && ($alt['title'] ?? '') !== 'Not found.' && ($alt['type'] ?? '') !== 'https://mediawiki.org/wiki/HyperSwitch/errors/not_found') {
            $data = $alt;
        }
    }

    if (!$data || empty($data['title']) || ($data['title'] ?? '') === 'Not found.') {
        echo json_encode([
            'success' => false,
            'name' => $name,
            'title' => $name,
            'description' => 'Professional hockey player',
            'extract' => 'Biographical profile on Wikipedia for ' . $name . '.',
            'wiki_url' => 'https://en.wikipedia.org/wiki/Special:Search?search=' . urlencode($name),
        ]);
        exit;
    }

    echo json_encode([
        'success' => true,
        'name' => $name,
        'title' => $data['title'] ?? $name,
        'description' => $data['description'] ?? 'Ice hockey player',
        'extract' => $data['extract'] ?? '',
        'thumbnail' => $data['thumbnail']['source'] ?? null,
        'wiki_url' => $data['content_urls']['desktop']['page'] ?? ('https://en.wikipedia.org/wiki/' . rawurlencode(str_replace(' ', '_', $data['title'] ?? $name))),
        'commons_url' => 'https://commons.wikimedia.org/w/index.php?search=' . rawurlencode($name),
    ]);
    exit;
}

fail('Unknown action');

// SYNC CHECKLIST for specific series
function syncSeriesCards($pdo, $checklist, $series = '2026-27') {
    $findNumbered = $pdo->prepare("SELECT id FROM cards WHERE (series = ? OR year = ?) AND set_name = ? AND card_number = ?");
    $findUnnumbered = $pdo->prepare("SELECT id FROM cards WHERE (series = ? OR year = ?) AND set_name = ? AND card_number = '' AND player_name = ?");
    $update = $pdo->prepare("UPDATE cards SET player_name = ?, sort_order = ?, year = COALESCE(NULLIF(year, ''), ?) WHERE id = ?");
    $insert = $pdo->prepare("INSERT INTO cards (series, year, set_name, card_number, player_name, sort_order) VALUES (?, ?, ?, ?, ?, ?)");

    $pdo->beginTransaction();
    foreach ($checklist as $i => $row) {
        $set = $row[0];
        $number = (string) $row[1];
        $player = $row[2];
        $order = $i + 1;
        if ($number !== '') {
            $findNumbered->execute([$series, $series, $set, $number]);
            $id = $findNumbered->fetchColumn();
        } else {
            $findUnnumbered->execute([$series, $series, $set, $player]);
            $id = $findUnnumbered->fetchColumn();
        }
        if ($id) {
            $update->execute([$player, $order, $series, $id]);
        } else {
            $insert->execute([$series, $series, $set, $number, $player, $order]);
        }
    }
    $pdo->commit();
}

// Seed Bronzo's collection for 2025-26 from spreadsheet
function seedBronzo2025Collection($pdo) {
    $stmtBronzo = $pdo->query("SELECT id FROM users WHERE collector_name = 'Bronzo' LIMIT 1");
    $bronzoId = $stmtBronzo ? $stmtBronzo->fetchColumn() : null;
    if (!$bronzoId) {
        try {
            $pdo->prepare("INSERT INTO users (initials, collector_name, team_name) VALUES ('EDJK', 'Bronzo', 'Hawks')")->execute();
            $bronzoId = (int) $pdo->lastInsertId();
        } catch (\Exception $e) {
            return;
        }
    }

    $has2025 = (int) $pdo->query("
        SELECT COUNT(*) FROM collections col
        JOIN cards cd ON cd.id = col.card_id
        WHERE col.user_id = $bronzoId AND cd.series = '2025-26'
    ")->fetchColumn();

    if ($has2025 === 0) {
        $file2025 = __DIR__ . '/checklist_2025_26.php';
        if (file_exists($file2025)) {
            $list2025 = require $file2025;
            $findCard = $pdo->prepare("SELECT id FROM cards WHERE series = '2025-26' AND set_name = ? AND card_number = ?");
            $insCol = $pdo->prepare("INSERT INTO collections (user_id, card_id, quantity, last_checked) VALUES (?, ?, ?, NOW()) ON DUPLICATE KEY UPDATE quantity = VALUES(quantity)");
            foreach ($list2025 as [$set, $num, $player, $qty]) {
                if ($qty > 0) {
                    $findCard->execute([$set, (string)$num]);
                    $cid = $findCard->fetchColumn();
                    if ($cid) {
                        $insCol->execute([$bronzoId, $cid, $qty]);
                    }
                }
            }
        }
    }
}
