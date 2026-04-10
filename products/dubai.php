<?php
include '../includes/visit_tracker.php';

track_last_visited("Dubai");
track_most_visited("Dubai");
?>


<?php 
$productName = "Dubai Desert Safari";
include '../includes/header.php';
?>

<h2>Dubai Desert Safari</h2>

<img src="../assets/images/dubai.jpg" width="400">

<p>
Enjoy thrilling dune bashing, camel rides and luxury desert
dinner experiences under the Arabian night sky.
</p>

<a href="../pages/products.php">Back to products</a>

<?php include '../includes/footer.php'; ?>