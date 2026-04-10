<?php
if (!isset($_COOKIE['visited_products'])) {
    $visited = [];
} else {
    $visited = json_decode($_COOKIE['visited_products'], true);
}

// Avoid duplicates
if (!in_array($productName, $visited)) {
    $visited[] = $productName;
}

setcookie('visited_products', json_encode($visited), time() + (86400 * 30), "/");
?>