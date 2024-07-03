<?php
// Instanciation de la classe Requete
$requete = new Request();

// Vérifier si des favoris existent dans la session
$favorites = [];
if (isset($_SESSION['favorites'])) {
    foreach ($_SESSION['favorites'] as $candyId) {
        $candy = $requete->getCandyById($candyId); // Vous devez ajouter cette méthode à votre classe Requete
        if ($candy) {
            $favorites[] = $candy;
        }
    }
}
?>
<main>
    <h2 class="title text-center mt-3 mb-4">Vos favoris</h2>
    <hr>
    <div class="product-grid container m-auto">
        <?php if (count($favorites) == 0) { ?>
            <div>Pas de favoris</div>
        <?php } else { ?>
            <?php foreach ($favorites as $candy): ?>
                <div class="card container m-auto card-container">
                    <div class="card-body">
                        <h5 class="card-title title-candy"><?= htmlspecialchars($candy["name"]) ?></h5>
                        <p class="card-text text-candy"><?= htmlspecialchars($candy["price"]) ?> €</p>
                        <img class="candy-pic-style" src="./assets/images/candies/<?= $candy["image"] ?>" alt="">
                        <button type="button" class="btn btn-secondary">Voir plus</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php } ?>
    </div>
</main>