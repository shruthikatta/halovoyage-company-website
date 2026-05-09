<?php

/** @return array<string, int> */
function hv_load_place_counts(string $path): array
{
    if (!is_file($path)) {
        return [];
    }
    $raw = file_get_contents($path);
    if ($raw === false || $raw === '') {
        return [];
    }
    $data = json_decode($raw, true);
    return is_array($data) ? array_map('intval', $data) : [];
}

function hv_place_counts_storage_path(): string
{
    return dirname(__DIR__) . '/data/hv_place_counts.json';
}

/**
 * Persist visit tallies server-side so api/marketplace-top-products.php (server fetch) matches most_visited.
 */
function hv_increment_place_count(string $place): void
{
    $place = trim($place);
    if ($place === '') {
        return;
    }
    $path = hv_place_counts_storage_path();
    $dir = dirname($path);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    $fp = fopen($path, 'c+');
    if ($fp === false) {
        return;
    }
    try {
        flock($fp, LOCK_EX);
        $counts = [];
        rewind($fp);
        $stat = fstat($fp);
        if ($stat && $stat['size'] > 0) {
            $raw = stream_get_contents($fp);
            $decoded = $raw !== false && $raw !== '' ? json_decode($raw, true) : [];
            if (is_array($decoded)) {
                $counts = array_map('intval', $decoded);
            }
        }
        $counts[$place] = ($counts[$place] ?? 0) + 1;
        ftruncate($fp, 0);
        rewind($fp);
        fwrite($fp, json_encode($counts));
        fflush($fp);
    } finally {
        flock($fp, LOCK_UN);
        fclose($fp);
    }
}

/**
 * @return list<string> place keys, highest visit count first (ties: key order stable via arsort)
 */
function hv_get_top_places(int $limit = 5): array
{
    $counts = hv_load_place_counts(hv_place_counts_storage_path());
    if ($counts === []) {
        return [];
    }
    arsort($counts);
    return array_slice(array_keys($counts), 0, max(1, $limit));
}

function track_last_visited($place) {
    if(isset($_COOKIE['visited_places'])) {
        $visited = json_decode($_COOKIE['visited_places'], true);
    } else {
        $visited = [];
    }

    array_unshift($visited, $place);
    $visited = array_unique($visited);
    $visited = array_slice($visited, 0, 5);

    setcookie('visited_places', json_encode($visited), time() + (7*24*60*60), "/");
    $_COOKIE['visited_places'] = json_encode($visited); 
}

function track_most_visited($place) {
    if(isset($_COOKIE['visit_count'])) {
        $counts = json_decode($_COOKIE['visit_count'], true);
    } else {
        $counts = [];
    }

    if(isset($counts[$place])) {
        $counts[$place]++;
    } else {
        $counts[$place] = 1;
    }

    setcookie('visit_count', json_encode($counts), time() + (7*24*60*60), "/");
    $_COOKIE['visit_count'] = json_encode($counts);
    hv_increment_place_count($place);
}

function get_last_visited() {
    return isset($_COOKIE['visited_places']) 
        ? json_decode($_COOKIE['visited_places'], true) 
        : [];
}

function get_most_visited() {
    $server = hv_get_top_places(5);
    if ($server !== []) {
        return $server;
    }
    if (isset($_COOKIE['visit_count'])) {
        $counts = json_decode($_COOKIE['visit_count'], true);
        if (is_array($counts)) {
            arsort($counts);
            return array_slice(array_keys($counts), 0, 5);
        }
    }
    return [];
}
?>