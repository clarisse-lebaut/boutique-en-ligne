<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home - Candy Shop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .nav {
            margin-bottom: 20px;
        }
        .nav a {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h1>Welcome to the Candy Shop</h1>
    
    <?php
    if (isset($_SESSION['message'])) {
        echo "<p style='color:green'>" . $_SESSION['message'] . "</p>";
        unset($_SESSION['message']);
    }

    if (isset($_SESSION['error'])) {
        echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    ?>

    <div class="nav">
        <?php
        if (isset($_SESSION['user_id'])) {
            echo "<p>Welcome, User " . $_SESSION['user_id'] . "</p>";
            echo "<p><a href='favorites/favorites.php'>View Favorites</a></p>";
            echo "<p><a href='auth.php'>Logout</a></p>";
        } else {
            echo "<p><a href='auth.php'>Login</a></p>";
            echo "<p><a href='auth.php'>Register</a></p>";
        }
        ?>
    </div>

    <h2>Available Products</h2>
    <p><a href="candy.php">View All Products</a></p>
</body>
</html>
