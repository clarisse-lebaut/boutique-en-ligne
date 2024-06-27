<main>
    <h1>Vos favoris</h1>
    <?php
    if (count($favorite) == 0) {
        ?>
        <div>
            Pas de favoris
        </div>
        <?php
    } else {
        foreach ($favorite as $candy) {
            ?>
            <div><?= $candy["name"] ?></div>
            <?php
        }
    }
    ?>
</main>

<?php
// if (!empty($favorites)) {
//     foreach ($favorites as $candy_id) {
//         // Assuming getProductById method retrieves candy details based on $candy_id
//         $candy_details = $product->getProductById($candy_id);
//         if ($candy_details) {
//             echo "<div class='candy'>";
//             echo "<h2><a href='candy_details.php?id=" . htmlspecialchars($candy_details["id"]) . "'>" . htmlspecialchars($candy_details["name"]) . "</a></h2>";
//             if (!empty($candy_details["image"])) {
//                 echo "<img src='" . htmlspecialchars($candy_details["image"]) . "' alt='" . htmlspecialchars($candy_details["name"]) . "'>";
//             }
//             echo "<p>Price: $" . htmlspecialchars($candy_details["price"]) . "</p>";
//             echo "<form method='post' action='favorite_toggle.php'>
//                           <input type='hidden' name='candy_id' value='" . htmlspecialchars($candy_details["id"]) . "'>
//                           <input type='submit' value='Remove from Favorites'>
//                         </form>";
//             echo "</div>";
//         }
//     }
// } else {
//     echo "<p>You have no favorite candies.</p>";
// }
?>