<?php
$pageTitle = "Panier";
// Initialiser le panier s'il n'existe pas
if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = array();
}

// Commencer la session si elle n'a pas déjà été démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Fonction pour vérifier si un utilisateur est connecté
function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

// Supprimer un article du panier
if (isset($_POST['delete_item'])) {
    $index = $_POST['delete_item'];
    if (isset($_SESSION['basket'][$index])) {
        unset($_SESSION['basket'][$index]);
        // Ré-indexer le tableau après suppression
        $_SESSION['basket'] = array_values($_SESSION['basket']);
    }
}

// Vider complètement le panier
if (isset($_POST['clear_cart'])) {
    $_SESSION['basket'] = array(); // Réinitialiser le panier à un tableau vide
}

// Si un utilisateur est connecté, sauvegarder le panier dans un cookie
if (isLoggedIn()) {
    $cookie_name = 'user_basket';
    $cookie_value = json_encode($_SESSION['basket']);
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // cookie valide pendant 30 jours
}

// Charger le panier à partir du cookie si disponible
if (isset($_COOKIE['user_basket'])) {
    $_SESSION['basket'] = json_decode($_COOKIE['user_basket'], true);
}
?>


<title><?php echo htmlspecialchars($pageTitle); ?></title>
<h1 class="user-name">
    <?php
    if (isLoggedIn()) {
        echo "" . htmlspecialchars($_SESSION['firstname']) . ", quelques clics et ces sucreries sont à vous !";
    } else {
        echo "Si vous souhaitez passer commande, connectez-vous ou créez un compte.";
    }
    ?>
</h1>

<div class="container mt-4 agency">
    <h3>Votre Panier</h3>
    <?php
    if (empty($_SESSION['basket'])) {
        echo "<p>Votre panier est vide.</p>";
    } else {
        $totalAmount = 0;
        echo "<div class='cart-items'>";
        foreach ($_SESSION['basket'] as $index => $item) {
            $itemTotal = $item['quantity'] * $item['price'];
            $totalAmount += $itemTotal;
            echo "<div class='cart-item'>";
            echo "<h2>" . htmlspecialchars($item['name']) . "</h2>";
            echo "<span class='quantity'>Quantité: " . htmlspecialchars($item['quantity']) . "</span>";
            echo "<span class='price'>Prix: " . htmlspecialchars(number_format($item['price'], 2)) . " €</span>";
            echo "<span class='item-total'>Total: " . htmlspecialchars(number_format($itemTotal, 2)) . " €</span>";
            echo "<form action='' method='post'>";
            echo "<input type='hidden' name='delete_item' value='" . htmlspecialchars($index) . "'>";
            echo "<input type='submit' value='Supprimer'>";
            echo "</form>";
            echo "</div>";
        }
        echo "</div>";
        echo "<div class='total-amount'>Montant total: " . htmlspecialchars(number_format($totalAmount, 2)) . " €</div>";
        echo "<form action='' method='post'>";
        echo "<input type='submit' name='clear_cart' value='Vider le panier'>";
        echo "</form>";
    }
    ?>
    <?php if (isLoggedIn()): ?>
        <form action="order.php" method="POST">
            <input type="submit" value="Passer commande">
        </form>
    <?php else: ?>
        <p><a href="./login.php">Connectez-vous</a> pour passer commande.</p>
    <?php endif; ?>

    <div class="link">
        <a href="./products.php">Retour aux produits</a>
        <a href="./index.php?page=<?= PAGE_HOME ?>">Revenir sur la page d'accueil</a>
    </div>
</div>

</body>

</html>