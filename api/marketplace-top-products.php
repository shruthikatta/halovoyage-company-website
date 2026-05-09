<?php
declare(strict_types=1);

/**
 * Marketplace feed — Halo Voyage (company_id 1).
 * Default: top 5 by server counts. ?catalog=all returns every destination in the catalog.
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

$COMPANY_ID = 1;

$catalogAll = isset($_GET['catalog']) && (string) $_GET['catalog'] === 'all';
$maxItems = $catalogAll ? 100 : 5;

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || (isset($_SERVER['SERVER_PORT']) && (string) $_SERVER['SERVER_PORT'] === '443') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/api/marketplace-top-products.php');
$siteRootPath = dirname(dirname($script));
if ($siteRootPath === '/' || $siteRootPath === '\\' || $siteRootPath === '.') {
    $origin = $scheme . '://' . $host;
} else {
    $origin = $scheme . '://' . $host . rtrim($siteRootPath, '/');
}

require_once dirname(__DIR__) . '/includes/visit_tracker.php';
require_once dirname(__DIR__) . '/includes/marketplace_catalog.php';

$catalog = hv_marketplace_destination_catalog($origin);
$counts = hv_load_place_counts(hv_place_counts_storage_path());

$items = [];

if ($catalogAll) {
    $keys = array_keys($catalog);
    sort($keys, SORT_STRING);
    foreach ($keys as $key) {
        if (!isset($catalog[$key])) {
            continue;
        }
        $row = $catalog[$key];
        $row['visit_count'] = (int) ($counts[$key] ?? 0);
        $items[] = $row;
        if (count($items) >= $maxItems) {
            break;
        }
    }
} else {
    $orderedKeys = hv_get_top_places(20);
    foreach ($orderedKeys as $key) {
        if (!isset($catalog[$key])) {
            continue;
        }
        $row = $catalog[$key];
        $row['visit_count'] = (int) ($counts[$key] ?? 0);
        $items[] = $row;
        if (count($items) >= $maxItems) {
            break;
        }
    }
}

if ($items === []) {
    $fallback = $catalogAll ? array_keys($catalog) : ['Maldives', 'Bali', 'Japan', 'Swiss', 'Paris'];
    foreach ($fallback as $key) {
        if (!isset($catalog[$key])) {
            continue;
        }
        $row = $catalog[$key];
        $row['visit_count'] = (int) ($counts[$key] ?? 0);
        $items[] = $row;
        if (count($items) >= $maxItems) {
            break;
        }
    }
}

echo json_encode(
    ['company_id' => $COMPANY_ID, 'products' => $items],
    JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
);
