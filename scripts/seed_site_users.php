<?php

declare(strict_types=1);

/**
 * Ensures halovoyage DB exists, creates site_users, seeds 22 lab users (INSERT IGNORE).
 * Uses same credentials as db.local.php when present, else InfinityFree vars from db.php (usually CLI = local).
 * Run: php scripts/seed_site_users.php
 */

$configDir = dirname(__DIR__) . '/includes';
if (is_file("$configDir/db.local.php")) {
    require_once "$configDir/db.local.php";
} else {
    $host = 'sql105.infinityfree.com';
    $user = 'if0_41377259';
    $password = 'rQHoXChaUgpeY';
    $database = 'if0_41377259_halovoyage';
}

if (!preg_match('/^[a-zA-Z0-9_]+$/', $database)) {
    fwrite(STDERR, "Invalid database name configured.\n");
    exit(1);
}

$dbPort = isset($db_port) ? (int) $db_port : null;
$bare = $dbPort !== null ? new mysqli($host, $user, $password, '', $dbPort) : new mysqli($host, $user, $password, '');

if ($bare->connect_error) {
    fwrite(STDERR, "Connection failed: {$bare->connect_error}\n");
    exit(1);
}

if (!$bare->query("CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci")) {
    fwrite(STDERR, "CREATE DATABASE failed: {$bare->error}\n");
    exit(1);
}
if (!$bare->select_db($database)) {
    fwrite(STDERR, "select_db failed: {$bare->error}\n");
    exit(1);
}

$conn = $bare;

$ddl = <<<SQL
CREATE TABLE IF NOT EXISTS `site_users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(80) NOT NULL,
  `last_name` VARCHAR(80) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `home_address` VARCHAR(500) NOT NULL,
  `home_phone` VARCHAR(40) NOT NULL,
  `cell_phone` VARCHAR(40) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_site_users_email` (`email`),
  KEY `idx_site_users_name` (`last_name`, `first_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
SQL;

if (!$conn->query($ddl)) {
    fwrite(STDERR, "CREATE TABLE failed: {$conn->error}\n");
    exit(1);
}

$seedRows = [
    ['Maya', 'Chen', 'maya.chen@email.test', '1200 Market St, San Jose, CA 95112', '(408) 555-0142', '(408) 555-8921'],
    ['Jordan', 'Reyes', 'jordan.reyes@email.test', '44 Palm Ave, Los Angeles, CA 90001', '(323) 555-2201', '(323) 555-7734'],
    ['Samira', 'Hassan', 'samira.hassan@email.test', '9 Lakeview Rd, Fremont, CA 94538', '(510) 555-6610', '(510) 555-4412'],
    ['Ethan', 'Park', 'ethan.park@email.test', '300 Valencia St, San Francisco, CA 94103', '(415) 555-9900', '(415) 555-1209'],
    ['Olivia', 'Nguyen', 'olivia.nguyen@email.test', '88 Harbor Dr, San Diego, CA 92101', '(619) 555-4488', '(619) 555-3012'],
    ['Liam', 'Okonkwo', 'liam.okonkwo@email.test', '5 Broadway, Oakland, CA 94607', '(510) 555-7788', '(510) 555-9033'],
    ['Ava', 'Martinez', 'ava.martinez@email.test', '210 Maple St, Sacramento, CA 95814', '(916) 555-5566', '(916) 555-2211'],
    ['Noah', 'Singh', 'noah.singh@email.test', '17 Cedar Ln, Mountain View, CA 94043', '(650) 555-3344', '(650) 555-8877'],
    ['Priya', 'Desai', 'priya.desai@email.test', '402 El Camino Real, Palo Alto, CA 94306', '(650) 555-6120', '(650) 555-1599'],
    ['Ben', 'Foster', 'ben.foster@email.test', '77 Bay St, Santa Cruz, CA 95060', '(831) 555-4820', '(831) 555-7113'],
    ['Riley', 'Thompson', 'riley.thompson@email.test', '19 Hill Rd, Berkeley, CA 94704', '(510) 555-9281', '(510) 555-3044'],
    ['Sofia', 'Almeida', 'sofia.almeida@email.test', '608 River Rd, Pasadena, CA 91103', '(626) 555-1188', '(626) 555-6405'],
    ['Diego', 'Castillo', 'diego.castillo@email.test', '250 Sunrise Blvd, Riverside, CA 92506', '(951) 555-2299', '(951) 555-8804'],
    ['Mia', 'Kowalski', 'mia.kowalski@email.test', '33 Pine St, San Mateo, CA 94403', '(650) 555-7660', '(650) 555-1223'],
    ['Caleb', 'Wright', 'caleb.wright@email.test', '900 Castro St, Redwood City, CA 94061', '(650) 555-3456', '(650) 555-9101'],
    ['Nina', 'Patel', 'nina.patel@email.test', '12 Blossom Way, Irvine, CA 92618', '(949) 555-7744', '(949) 555-2288'],
    ['Hugo', 'Silva', 'hugo.silva@email.test', '45 Ocean Ave, Long Beach, CA 90803', '(562) 555-6601', '(562) 555-9955'],
    ['Emma', 'Brooks', 'emma.brooks@email.test', '8 Vineyard Cir, Napa, CA 94558', '(707) 555-4477', '(707) 555-3300'],
    ['Arjun', 'Mehta', 'arjun.mehta@email.test', '511 Union Sq, Walnut Creek, CA 94596', '(925) 555-8123', '(925) 555-4679'],
    ['Zoe', 'Larsson', 'zoe.larsson@email.test', '66 Bridge St, Ventura, CA 93003', '(805) 555-2590', '(805) 555-7012'],
    ['Tyler', 'Johnson', 'tyler.johnson@email.test', '1440 Pine Ave, Fresno, CA 93721', '(559) 555-8844', '(559) 555-1166'],
    ['Grace', 'Okafor', 'grace.okafor@email.test', '3 Sunrise Ct, Anaheim, CA 92805', '(714) 555-3322', '(714) 555-9099'],
];

$stmt = $conn->prepare(
    'INSERT IGNORE INTO site_users (first_name, last_name, email, home_address, home_phone, cell_phone) VALUES (?,?,?,?,?,?)'
);
if (!$stmt) {
    fwrite(STDERR, "Prepare failed: {$conn->error}\n");
    exit(1);
}

$inserted = 0;
foreach ($seedRows as $r) {
    $stmt->bind_param('ssssss', $r[0], $r[1], $r[2], $r[3], $r[4], $r[5]);
    $stmt->execute();
    $inserted += $stmt->affected_rows;
}
$stmt->close();

$r = $conn->query('SELECT COUNT(*) AS c FROM site_users');
$row = $r ? $r->fetch_assoc() : ['c' => 0];
$n = (int) ($row['c'] ?? 0);

echo "Seed OK. Rows inserted this run (new emails only): {$inserted}. Total in site_users: {$n}\n";

if ($n < 20) {
    fwrite(STDERR, "Warning: lab needs at least 20 users.\n");
    exit(1);
}
