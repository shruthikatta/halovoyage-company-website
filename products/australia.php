<?php
include '../includes/visit_tracker.php';

track_last_visited("Australia");
track_most_visited("Australia");
?>



<?php 
$productName = "Australia Reef Adventure";
include '../includes/header.php';
?>

<h2>Australia Reef Adventure</h2>

<img src="../assets/images/australia.jpg" width="400">

<p>
Dive into the Great Barrier Reef and explore Australia's unique
marine life and beautiful coastal cities.
</p>

<a href="../pages/products.php">Back to products</a>

<?php include '../includes/footer.php'; ?>