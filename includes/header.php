<?php
require_once __DIR__ . '/marketplace_partner_visit.php';
marketplace_partner_report_visit_to_hub();

$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>HaloVoyage Travel Agency</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>

<header>
    <h1>HaloVoyage</h1>

    <nav>
        <a href="/index.php" class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">Home</a>

<?php $users_nav_active = in_array($current_page, ['users.php', 'user_create.php', 'user_search.php'], true); ?>
        <a href="/pages/users.php" class="<?= $users_nav_active ? 'active' : '' ?>">Users</a>

        <a href="/pages/about.php" class="<?= ($current_page == 'about.php') ? 'active' : '' ?>">About</a>

        <a href="/pages/products.php" class="<?= ($current_page == 'products.php') ? 'active' : '' ?>">Products</a>

        <a href="/pages/news.php" class="<?= ($current_page == 'news.php') ? 'active' : '' ?>">News</a>

        <a href="/pages/contacts.php" class="<?= ($current_page == 'contacts.php') ? 'active' : '' ?>">Contacts</a>

        <a href="/secure/login.php" class="<?= ($current_page == 'login.php') ? 'active' : '' ?>">Login</a>
    </nav>
</header>

<main>