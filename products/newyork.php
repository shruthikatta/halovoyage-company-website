
<?php
include '../includes/visit_tracker.php';

track_last_visited("New York");
track_most_visited("New York");
?>


<?php 
$productName = "New York City Explorer";
include '../includes/header.php';
?>

<h2>New York City Explorer</h2>

<img src="../assets/images/newyork.jpg" width="400">

<p>
Discover Times Square, Central Park, Statue of Liberty and Broadway
in the exciting city that never sleeps.
</p>

<a href="../pages/products.php">Back to products</a>

<?php include '../includes/footer.php'; ?>