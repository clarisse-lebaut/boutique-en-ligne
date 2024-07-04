<?php
// Instanciation de la classe Requete
$requete = new Request();



// Vérifie si l'identifiant du bonbon à supprimer est présent
if (isset($_POST['candyId'])) {
    $candyIdToRemove = $_POST['candyId'];

    // Retirer le bonbon de la session des favoris s'il existe
    if (isset($_SESSION['favorites'])) {
        $key = array_search($candyIdToRemove, $_SESSION['favorites']);
        if ($key !== false) {
            unset($_SESSION['favorites'][$key]);
            $message = "Bonbon supprimer des favoris !";
            // Réindexer le tableau après suppression
            $_SESSION['favorites'] = array_values($_SESSION['favorites']);
        }
    }
}

// Vérifier si des favoris existent dans la session
$favorites = [];
if (isset($_SESSION['favorites'])) {
    foreach ($_SESSION['favorites'] as $candyId) {
        $candy = $requete->getCandyById($candyId);
        if ($candy) {
            $favorites[] = $candy;
        }
    }
}
?>
<main>
    <h2 class="title text-center mt-3 mb-4">Vos favoris</h2>
    <hr>
    <div class="product-grid container m-auto mt-4">
        <?php if (count($favorites) == 0) { ?>
            <div>Pas de favoris</div>
        <?php } else {
            $count = 0; // Pour alterner les couleurs
            foreach ($favorites as $candy): ?>
                <div class="card container m-auto card-container <?= ($count % 2 == 0) ? 'white' : 'pink' ?>">
                    <div class="card-body">
                        <h5 class="card-title title-candy"><?= htmlspecialchars($candy["name"]) ?></h5>
                        <p class="card-text text-candy"><?= htmlspecialchars($candy["price"]) ?> €</p>
                        <img class="candy-pic-style" src="./assets/images/candies/<?= $candy["image"] ?>" alt="">
                        <form action="" method="POST">
                            <input type="hidden" name="candyId" value="<?= $candy['id'] ?>">
                            <button type="submit" class="btn btn-primary" name="deleteFav">Supprimer des favoris</button>
                        </form>
                        <button type="button" class="btn btn-secondary">Voir plus</button>
                    </div>
                </div>
                <?php $count++;
            endforeach;
        } ?>
    </div>
</main>