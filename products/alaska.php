<?php
include '../includes/visit_tracker.php';

track_last_visited("Alaska");
track_most_visited("Alaska");
?>

<?php 
$productName = "Alaska Glacier Cruise";
include '../includes/header.php';
?>

<h2>Alaska Glacier Cruise</h2>

<img src="../assets/images/alaska.jpg" width="400">

<p>
Witness giant glaciers, whales, and breathtaking mountain scenery
on an unforgettable Alaska cruise adventure.
</p>

<a href="../pages/products.php">Back to products</a>

<?php include '../includes/footer.php'; ?>