<?php 
include '../includes/visit_tracker.php';
include '../includes/header.php'; 
?>

<h2>Most Visited Places</h2>

<?php
$destinations = [
    "Paris" => [
        "name" => "Paris",
        "image" => "../assets/images/paris.jpg",
        "link" => "../products/paris.php"
    ],
    "Bali" => [
        "name" => "Bali",
        "image" => "../assets/images/bali.jpg",
        "link" => "../products/bali.php"
    ],
    "Alaska" => [
        "name" => "Alaska Glacier Cruise",
        "image" => "../assets/images/alaska.jpg",
        "link" => "../products/alaska.php"
    ],
    "Swiss" => [
        "name" => "Swiss Alps",
        "image" => "../assets/images/swiss.jpg",
        "link" => "../products/swiss.php"
    ],
    "Dubai" => [
        "name" => "Dubai",
        "image" => "../assets/images/dubai.jpg",
        "link" => "../products/dubai.php"
    ],
    "Japan" => [
        "name" => "Japan",
        "image" => "../assets/images/japan.jpg",
        "link" => "../products/japan.php"
    ],
    "Thailand" => [
        "name" => "Thailand",
        "image" => "../assets/images/thailand.jpg",
        "link" => "../products/thailand.php"
    ],
    "Maldives" => [
        "name" => "Maldives",               
        "image" => "../assets/images/maldives.jpg",
        "link" => "../products/maldives.php"
    ],
    "New York" => [
        "name" => "New York",
        "image" => "../assets/images/newyork.jpg",          
        "link" => "../products/newyork.php"
    ]   
];
?>

<div class="card-container">
<?php
$visited = get_most_visited(); 

if(!empty($visited)) {
    foreach($visited as $place) {

        if(!isset($destinations[$place])) continue;

        $data = $destinations[$place];

        echo "
        <a href='{$data['link']}' class='card-link'>
            <div class='card'>
                <img src='{$data['image']}' alt='{$data['name']}'>
                <h3>{$data['name']}</h3>
                <p>Most popular</p>
            </div>
        </a>";
    }
} else {
    echo "<p>No data available yet.</p>";
}
?>
</div>

<br>
<a href="products.php">← Back to Products</a>

<?php include '../includes/footer.php'; ?>