<?php
session_start();

require_once 'db.php';
require_once 'candy_class.php';

$candy = new candy();

// Handle adding/removing from favorites
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['candy_id'])) {
    $candy_id = $_POST['candy_id'];
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    if ($user_id) {
        try {
            if ($candy->isFavorite($user_id, $candy_id)) {
                $candy->removeFromFavorites($user_id, $candy_id);
                $message = "Candy removed from favorites.";
            } else {
                $candy->addToFavorites($user_id, $candy_id);
                $message = "Candy added to favorites.";
            }
        } catch (Exception $e) {
            $error_message = "Error: " . $e->getMessage();
        }
    } else {
        $error_message = "Please log in to add to favorites.";
    }
}

// Define number of candies per page
$candys_per_page = 5;

// Get current page number
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Check if candy details are requested
if (isset($_GET['id'])) {
    $candy_id = (int)$_GET['id'];
    $candy_details = $candy->getcandyById($candy_id);
}

// Display candies or candy details based on request
if (isset($candy_details) && $candy_details) {
    // candy details page
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title><?php echo isset($candy_details["name"]) ? $candy_details["name"] : "Candy Details"; ?></title>
        <style>
            body {
                font-family: Arial, sans-serif;
            }
            .candy {
                border: 1px solid #ddd;
                padding: 10px;
                margin-top: 20px;
            }
            .candy img {
                max-width: 200px;
                max-height: 200px;
            }
            .candy h1 {
                margin: 0;
            }
            .candy p {
                margin: 5px 0;
            }
        </style>
    </head>
    <body>
        <?php
        echo "<div class='candy'>";
        echo "<h1>" . $candy_details["name"] . "</h1>";
        if (!empty($candy_details["image"])) {
            echo "<img src='" . $candy_details["image"] . "' alt='" . $candy_details["name"] . "'><br>";
        }
        echo "<p>Price: $" . $candy_details["price"] . "</p>";
        echo "<p>Stock: " . $candy_details["nb_stock"] . " units available</p>";
        echo "<p>Mark: " . $candy_details["mark_name"] . "</p>";
        echo "<p>Created at: " . $candy_details["created_at"] . "</p>";

        // Show message or error
        if (isset($message)) {
            echo "<p>$message</p>";
        } elseif (isset($error_message)) {
            echo "<p>$error_message</p>";
        }

        // Check if candy is in favorites
        $favorites = isset($_COOKIE['favorites']) ? unserialize($_COOKIE['favorites']) : [];
        if (in_array($candy_id, $favorites)) {
            echo "<form method='post' action=''>
                    <input type='hidden' name='candy_id' value='$candy_id'>
                    <input type='submit' value='Remove from Favorites'>
                  </form>";
        } else {
            echo "<form method='post' action=''>
                    <input type='hidden' name='candy_id' value='$candy_id'>
                    <input type='submit' value='Add to Favorites'>
                  </form>";
        }

        echo "</div>";
        ?>
    </body>
    </html>

    <?php
} else {
    // candy listing page

    // Get paginated candies
    $candys = $candy->getPaginatedcandy($page, $candys_per_page);

    // Get total number of candies
    $total_candys = $candy->getTotalcandyCount();

    // Calculate total number of pages
    $total_pages = ceil($total_candys / $candys_per_page);

    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Candy Listing</title>
        <style>
            body {
                font-family: Arial, sans-serif;
            }
            .pagination {
                margin: 20px 0;
            }
            .pagination a, .pagination strong {
                padding: 5px 10px;
                text-decoration: none;
                border: 1px solid #ccc;
                margin-right: 5px;
            }
            .pagination strong {
                background-color: #f0f0f0;
            }
            .candy {
                border: 1px solid #ddd;
                padding: 10px;
                margin-bottom: 10px;
            }
            .candy h2 {
                margin: 0;
            }
            .candy p {
                margin: 5px 0;
            }
            .favorite-form {
                display: inline-block;
                margin-left: 10px;
            }
        </style>
    </head>
    <body>
        <h1>Candies</h1>
        <?php
        if (count($candys) > 0) {
            foreach ($candys as $row) {
                echo "<div class='candy'>";
                echo "<h2><a href='?id=" . $row["id"] . "'>" . $row["name"] . "</a></h2>";
                echo "<p>Price: $" . $row["price"] . "</p>";

                // Add to Favorites button
                echo "<form method='post' class='favorite-form'>
                        <input type='hidden' name='candy_id' value='" . $row["id"] . "'>
                        <input type='submit' value='Add to Favorites'>
                      </form>";

                echo "</div>";
            }

            // Display pagination links
            echo "<div class='pagination'>";
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    echo "<strong>$i</strong> ";
                } else {
                    echo "<a href='?page=$i'>$i</a> ";
                }
            }
            echo "</div>";
        } else {
            echo "<p>No candies available.</p>";
        }
        ?>
    </body>
    </html>

    <?php
}
?>
