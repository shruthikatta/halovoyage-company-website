<?php

mysqli_report(MYSQLI_REPORT_OFF);

/**
 * Local overrides live in db.local.php (gitignored). On InfinityFree, that file is often uploaded by mistake;
 * it points to 127.0.0.1 → "Connection refused" because MySQL is not on the web server's loopback.
 *
 * Only load db.local.php for real local dev: CLI, PHP's built-in server, or SERVER_NAME localhost/127.0.0.1.
 * On your public host (shruthikatta.me, etc.), production credentials below are always used.
 */
$hasLocalFile = file_exists(__DIR__ . '/db.local.php');
$forceProduction = getenv('HV_FORCE_PRODUCTION_DB') === '1';
$sapi = PHP_SAPI;
$serverName = (string) ($_SERVER['SERVER_NAME'] ?? '');

$useLocalDb = $hasLocalFile
    && !$forceProduction
    && (
        $sapi === 'cli'
        || $sapi === 'cli-server'
        || in_array($serverName, ['localhost', '127.0.0.1'], true)
    );

if ($useLocalDb) {
    require __DIR__ . '/db.local.php';
} else {
    $host = 'sql105.infinityfree.com';
    $user = 'if0_41377259';
    $password = 'rQHoXChaUgpeY';
    $database = 'if0_41377259_halovoyage';
}

if (isset($db_port)) {
    $conn = new mysqli($host, $user, $password, $database, (int) $db_port);
} else {
    $conn = new mysqli($host, $user, $password, $database);
}

if ($conn->connect_error) {
    http_response_code(503);
    header('Content-Type: text/plain; charset=utf-8');
    exit(
        "Database connection failed.\r\n\r\n"
        . "Details: " . $conn->connect_error . "\r\n\r\n"
        . "Notes:\r\n"
        . '- "Connection refused" usually means PHP targeted 127.0.0.1 (local), not InfinityFree MySQL, or local MySQL is stopped.'
        . "\r\n"
        . "- InfinityFree: use the exact MySQL hostname from Control Panel → MySQL (e.g. sqlXXX.infinityfree.com).\r\n"
        . '- This site skips db.local.php on your public domain so production uses the InfinityFree vars in includes/db.php.'
    );
}
