<?php
include '../includes/visit_tracker.php';

track_last_visited("Bali");
track_most_visited("Bali");
?>

<?php 
$productName = "Bali Adventure Trip";
include '../includes/header.php';
?>

<h2>Bali Adventure Trip</h2>

<img src="../assets/images/bali.jpg" width="400">

<p>
Experience waterfalls, jungle temples, rice terraces and beaches
in one of the world's most beautiful tropical destinations.
</p>

<a href="../pages/products.php">Back to products</a>

<?php include '../includes/footer.php'; ?>