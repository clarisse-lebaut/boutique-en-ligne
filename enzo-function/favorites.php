<?php
// Include necessary files
require_once 'candy.php';

// Initialize candy or Candy class (adjust based on your implementation)
$candy = new candy();

// Check if the $candy object is properly initialized
if (!$candy) {
    die('Error: Failed to initialize candy object.');
}

// Retrieve favorites array from cookie
$favorites = isset($_COOKIE['favorites']) ? unserialize($_COOKIE['favorites']) : [];

// If favorites array is not an array or not set, initialize it as an empty array
if (!is_array($favorites)) {
    $favorites = [];
}

// Handle form submission to add/remove candy from favorites
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $candy_id = $_POST['candy_id'];

    // Toggle candy in favorites array
    if (in_array($candy_id, $favorites)) {
        // Remove candy from favorites array
        $favorites = array_diff($favorites, [$candy_id]);
    } else {
        // Add candy to favorites array
        $favorites[] = $candy_id;
    }

    // Update favorites cookie
    setcookie('favorites', serialize($favorites), time() + (86400 * 30), '/');

    // Redirect back to previous page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

// Get favorite candies
$favorite_candies = [];
foreach ($favorites as $candy_id) {
    $candy_item = $candy->getcandyById($candy_id);
    if ($candy_item) {
        $favorite_candies[] = $candy_item;
    }
}
?>

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
    <?php if (empty($favorite_candies)): ?>
        <p>You have no favorite candies.</p>
    <?php else: ?>
        <?php foreach ($favorite_candies as $candy): ?>
            <div class="candy">
                <h2><a href="candy_details.php?id=<?= $candy['id'] ?>"><?= $candy['name'] ?></a></h2>
                <?php if (!empty($candy['image'])): ?>
                    <img src="<?= $candy['image'] ?>" alt="<?= $candy['name'] ?>">
                <?php endif; ?>
                <p>Price: $<?= $candy['price'] ?></p>
                <form method="post" action="">
                    <input type="hidden" name="candy_id" value="<?= $candy['id'] ?>">
                    <input type="submit" value="<?= (in_array($candy['id'], $favorites)) ? 'Remove from Favorites' : 'Add to Favorites' ?>">
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
