<?php
session_start();

// Include necessary files
require_once 'Product.php'; // Adjust this based on your file structure and class name

// Initialize Product or Candy class (adjust based on your implementation)
$product = new Product();

// Retrieve favorites array from cookie
$favorites = isset($_COOKIE['favorites']) ? unserialize($_COOKIE['favorites']) : [];

// If favorites array is not an array or not set, initialize it as an empty array
if (!is_array($favorites)) {
    $favorites = [];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Favorites</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .candy {
            border: 1px solid #ddd;
            margin-bottom: 20px;
            padding: 10px;
        }
        .candy img {
            max-width: 100px;
            max-height: 100px;
        }
        .candy h2 {
            margin: 0;
        }
        .candy p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h1>Your Favorites</h1>
    <?php
    if (!empty($favorites)) {
        foreach ($favorites as $candy_id) {
            // Assuming getProductById method retrieves candy details based on $candy_id
            $candy_details = $product->getProductById($candy_id);
            if ($candy_details) {
                echo "<div class='candy'>";
                echo "<h2><a href='candy_details.php?id=" . $candy_details["id"] . "'>" . $candy_details["name"] . "</a></h2>";
                if (!empty($candy_details["image"])) {
                    echo "<img src='" . $candy_details["image"] . "' alt='" . $candy_details["name"] . "'>";
                }
                echo "<p>Price: $" . $candy_details["price"] . "</p>";
                echo "<form method='post' action='favorite_toggle.php'>
                          <input type='hidden' name='candy_id' value='" . $candy_details["id"] . "'>
                          <input type='submit' value='Remove from Favorites'>
                        </form>";
                echo "</div>";
            }
        }
    } else {
        echo "<p>You have no favorite candies.</p>";
    }
    ?>
    <h1>All Candies</h1>
    <?php
    // Assuming getAllProducts method retrieves all candy details
    $all_candies = $product->getAllProducts();
    if (!empty($all_candies)) {
        foreach ($all_candies as $candy) {
            echo "<div class='candy'>";
            echo "<h2><a href='candy_details.php?id=" . $candy["id"] . "'>" . $candy["name"] . "</a></h2>";
            if (!empty($candy["image"])) {
                echo "<img src='" . $candy["image"] . "' alt='" . $candy["name"] . "'>";
            }
            echo "<p>Price: $" . $candy["price"] . "</p>";
            if (in_array($candy["id"], $favorites)) {
                echo "<p>Already in Favorites</p>";
            } else {
                echo "<form method='post' action='favorite_toggle.php'>
                          <input type='hidden' name='candy_id' value='" . $candy["id"] . "'>
                          <input type='submit' value='Add to Favorites'>
                        </form>";
            }
            echo "</div>";
        }
    } else {
        echo "<p>No candies available.</p>";
    }
    ?>
</body>
</html>
