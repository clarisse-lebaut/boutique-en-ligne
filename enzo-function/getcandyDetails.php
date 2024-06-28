<?php
require_once 'db.php';
require_once 'candy_class.php';

if (isset($_GET['id'])) {
    $candy_id = (int)$_GET['id'];
    $candy = new candy();
    $candy_details = $candy->getcandyById($candy_id);

    if ($candy_details) {
        echo "<h1>" . $candy_details["name"] . "</h1>";
        if (!empty($candy_details["image"])) {
            echo "<img src='" . $candy_details["image"] . "' alt='" . $candy_details["name"] . "' class='img-fluid'><br>";
        }
        echo "<p>Price: $" . $candy_details["price"] . "</p>";
        echo "<p>Stock: " . $candy_details["nb_stock"] . " units available</p>";
        echo "<p>Mark: " . $candy_details["mark_name"] . "</p>";
        echo "<p>Created at: " . $candy_details["created_at"] . "</p>";
    } else {
        echo "<p>Candy details not found.</p>";
    }
}
?>
