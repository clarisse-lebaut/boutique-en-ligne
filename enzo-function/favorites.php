<?php
session_start();
// Include necessary files
require_once 'candy.php';

// Initialize Candy class
$candy = new Candy();

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
        $favorites = array_diff($favorites, [$candy_id]);
    } else {
        $favorites[] = $candy_id;
    }
    // Update favorites cookie
    setcookie('favorites', serialize($favorites), time() + (86400 * 30), '/', '', true, true);
    // Redirect to prevent form resubmission
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Get favorite candies
$favorite_candies = array_filter(array_map([$candy, 'getCandyById'], $favorites));

// Get all candies
$all_candies = $candy->getAllCandies();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candy Favorites</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        .candy-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .candy {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            width: 200px;
        }
        .candy img {
            max-width: 100%;
            height: auto;
        }
        .candy h2 {
            margin: 10px 0;
            font-size: 1.2em;
        }
        .candy p {
            margin: 5px 0;
        }
        .candy form {
            margin-top: 10px;
        }
        .candy input[type="submit"] {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>Your Favorites</h1>
    <div class="candy-container">
    <?php if (empty($favorite_candies)): ?>
        <p>You have no favorite candies.</p>
    <?php else: ?>
        <?php foreach ($favorite_candies as $candy): ?>
            <div class="candy">
                <h2><a href="candy_details.php?id=<?= htmlspecialchars($candy['id']) ?>"><?= htmlspecialchars($candy['name']) ?></a></h2>
                <?php if (!empty($candy['image'])): ?>
                    <img src="<?= htmlspecialchars($candy['image']) ?>" alt="<?= htmlspecialchars($candy['name']) ?>">
                <?php endif; ?>
                <p>Price: $<?= number_format($candy['price'], 2) ?></p>
                <form method="post">
                    <input type="hidden" name="candy_id" value="<?= htmlspecialchars($candy['id']) ?>">
                    <input type="submit" value="Remove from Favorites">
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    </div>

    <h1>Available Candies</h1>
    <div class="candy-container">
    <?php if (empty($all_candies)): ?>
        <p>No candies available.</p>
    <?php else: ?>
        <?php foreach ($all_candies as $candy): ?>
            <div class="candy">
                <h2><a href="candy_details.php?id=<?= htmlspecialchars($candy['id']) ?>"><?= htmlspecialchars($candy['name']) ?></a></h2>
                <?php if (!empty($candy['image'])): ?>
                    <img src="<?= htmlspecialchars($candy['image']) ?>" alt="<?= htmlspecialchars($candy['name']) ?>">
                <?php endif; ?>
                <p>Price: $<?= number_format($candy['price'], 2) ?></p>
                <form method="post">
                    <input type="hidden" name="candy_id" value="<?= htmlspecialchars($candy['id']) ?>">
                    <input type="submit" value="<?= in_array($candy['id'], $favorites) ? 'Remove from Favorites' : 'Add to Favorites' ?>">
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    </div>
</body>
</html>