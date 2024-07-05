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
                <div class="modal fade" id="candyInfos<?= $candy["id"] ?>" tabindex="-1"
                    aria-labelledby="candyInfos<?= $candy["id"] ?>Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $candy["name"] ?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><?= htmlspecialchars($candy["price"]) ?> €</p>
                                <p><?= htmlspecialchars($candy["mark_name"]) ?></p>
                                <p><?= htmlspecialchars($candy["image"]) ?></p>
                                <p><?= htmlspecialchars($candy["description"]) ?></p>
                                <h1>Commentaires</h1>
                                <?php
                                $comments = $request->getCommentary($candy["id"]);
                                if (count($comments) == 0) {
                                    ?>
                                    <p>Pas</p>
                                    <?php
                                } else {
                                    foreach ($comments as $comment) {
                                        ?>
                                        <p><?= htmlspecialchars($comment["content"]) ?></p>
                                        <p><?= htmlspecialchars($comment["created_at"]) ?></p>
                                        <p><?= htmlspecialchars($comment["updated_at"]) ?></p>
                                        <p><?= htmlspecialchars($comment["creator_firstname"]) ?></p>
                                        <p><?= htmlspecialchars($comment["creator_lastname"]) ?></p>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="modal-footer">
                                <!-- bouton pour ajouter favoris -->
                                <?php if (isset($_SESSION["accountId"])) { ?>
                                    <a href="index.php?page=<?= $_GET['page'] ?>&action=add_favorite&candy_id=<?= $candy["id"] ?>"
                                        class="btn btn-primary">
                                        <img class="svg-candy" src="../assets/images/icon/favorite.svg" alt="">
                                    </a>
                                <?php } ?>

                                <!-- bouton pour ajouter au panier -->
                                <a href="index.php?page=<?= $_GET['page'] ?>&action=add_to_cart&candy_id=<?= $candy["id"] ?>"
                                    class="btn btn-secondary">
                                    <img class="svg-candy" src="../assets/images/icon/basket.svg" alt="">
                                </a>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card container m-auto card-container <?= ($count % 2 == 0) ? 'white' : 'pink' ?>">
                    <div class="card-body">
                        <h5 class="card-title title-candy"><?= htmlspecialchars($candy["name"]) ?></h5>
                        <p class="card-text text-candy"><?= htmlspecialchars($candy["price"]) ?> €</p>
                        <img class="candy-pic-style" src="./assets/images/candies/<?= $candy["image"] ?>" alt="">
                        <form action="" method="POST">
                            <input type="hidden" name="candyId" value="<?= $candy['id'] ?>">
                            <button type="submit" class="btn btn-primary" name="deleteFav">Supprimer des favoris</button>
                        </form> <!-- bouton pour afficher le modal et faire apparaître les détails d'un produit -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#candyInfos<?= $candy["id"] ?>">
                            Voir plus
                        </button>
                    </div>
                </div>
                <?php $count++;
            endforeach;
        } ?>
    </div>
</main>