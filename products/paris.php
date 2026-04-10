<?php
include '../includes/visit_tracker.php';

track_last_visited("Paris");
track_most_visited("Paris");
?>

<?php 
$productName = "Paris City Tour";
include '../includes/header.php';
?>

<h2>Paris City Tour</h2>

<img src="../assets/images/paris.jpg" width="400">

<p>
Explore the romantic city of Paris including the Eiffel Tower,
Louvre Museum, Seine River Cruise and world famous cafes.
</p>

<a href="../pages/products.php">Back to products</a>

<?php include '../includes/footer.php'; ?>