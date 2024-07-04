<?php
$requete = new Request(); // Instanciation de votre classe Requete
$cart = []; // Initialisez le tableau pour stocker les produits du panier

// Suppression d'un article du panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove'])) {
    $candyIdToRemove = $_POST['candyId'];
    if (($key = array_search($candyIdToRemove, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
        // Réindexer le tableau pour éviter des trous dans les clés
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}
// Vérifiez si le panier existe dans la session
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Parcourez les bonbons dans le panier et récupérez leurs détails
    foreach ($_SESSION['cart'] as $candyId) {
        $candy = $requete->getCandyById($candyId); // Supposons que getCandyById récupère les détails du bonbon par son ID
        if ($candy) {
            $cart[] = $candy; // Ajoutez le bonbon au tableau $cart
        }
    }
}
?>

<main>
    <h2 class="title text-center mt-3 mb-4">Votre Panier</h2>
    <hr>
    <div class="product-grid container m-auto mt-4">
        <?php if (count($cart) == 0) { ?>
            <div>Le panier est vide.</div>
        <?php } else { ?>
            <?php foreach ($cart as $key => $candy): ?>
                <div class="card container m-auto card-container">
                    <div class="card-body">
                        <h5 class="card-title title-candy"><?= htmlspecialchars($candy["name"]) ?></h5>
                        <p class="card-text text-candy"><?= htmlspecialchars($candy["price"]) ?> €</p>
                        <img class="candy-pic-style" src="./assets/images/candies/<?= $candy["image"] ?>" alt="">
                        <form method="post" action="">
                            <input type="hidden" name="candyId" value="<?= $candy['id'] ?>">
                            <label for="quantity">Quantité : </label>
                            <input type="number" name="quantity" value="1" min="1">
                            <div style="display:flex; flex-direction:column;">
                                <button type="submit" name="update" class="btn btn-primary">Mettre à jour</button>
                                <button type="submit" name="remove" class="btn btn-danger">Supprimer</button>
                                <button type="button" class="btn btn-secondary">Voir plus</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php } ?>
    </div>
</main>