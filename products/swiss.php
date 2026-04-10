
<?php
include '../includes/visit_tracker.php';

track_last_visited("Swiss");
track_most_visited("Swiss");
?>



<?php 
$productName = "Swiss Alps Ski Tour";
include '../includes/header.php';
?>

<h2>Swiss Alps Ski Tour</h2>

<img src="../assets/images/swiss.jpg" width="400">

<p>
Ski the beautiful Swiss Alps, explore alpine villages and enjoy
the finest Swiss chocolate and mountain scenery.
</p>

<a href="../pages/products.php">Back to products</a>

<?php include '../includes/footer.php'; ?>