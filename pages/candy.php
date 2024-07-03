<?php
// Instanciation de la classe Requete
$requete = new Request();

// Appel de la méthode pour récupérer les catégories
$categories = $requete->getCategories();
$classification = $requete->getClassificationCandy();

// Ajouter un bonbon aux favoris
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_favorite'])) {
    $candyId = $_POST['candy_id'];

    // Initialiser le tableau des favoris s'il n'existe pas
    if (!isset($_SESSION['favorites'])) {
        $_SESSION['favorites'] = [];
    }

    // Ajouter le bonbon aux favoris s'il n'est pas déjà présent
    if (!in_array($candyId, $_SESSION['favorites'])) {
        $_SESSION['favorites'][] = $candyId;
    }

}

//Ajouter un bonbon au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $candyId = $_POST['candy_id'];

    // Initialiser le panier s'il n'existe pas encore
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Ajouter le bonbon au panier s'il n'est pas déjà présent
    if (!in_array($candyId, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $candyId;
    }
}
?>

<main>
    <h2 class="title text-center mt-3 mb-4">Les douceurs de notre catalogue</h2>
    <hr>

    <!-- PART : for the filter et get prodcut in db by category -->
    <h3 class="container">
        <h3 class="title text-center mt-3 mb-4">Filtres</h3>
        <form type="submit" action="index.php?page=<?= FILTER_PRODUCTS ?>" method="POST">
            <select name="sltFilter">
                <option value="all">Afficher tous les produits</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category["id"] ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" name="btnFilter" value="Filtrer">
        </form>

        <!-- PART : to make appears all the products in db and by category with filter -->
        <h3 class="title text-center mt-5 mb-5">Nos produits</h3>
        <div class="product-grid container m-auto">
            <?php if (count($candies) == 0) { ?>
                <div>Pas de bonbon</div>
            <?php } else { ?>
                <?php foreach ($candies as $index => $candy):
                    $colorClass = ($index % 2 == 0) ? 'card-even' : 'card-odd'; // Définir la classe basée sur l'index
                    ?>
                    <!-- ceci est le modal pour chaque carte -->
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
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ceci est la div dans laquelle il y a toutes les cards -->
                    <div class="card <?= $colorClass ?> container m-auto card-container">
                        <input type="hidden" name="candy" value='<?= $candy["id"] ?>'>
                        <input class="name" type="hidden" name="candy_name" value='<?= htmlspecialchars($candy["name"]) ?>'>
                        <input class="price" type="hidden" name="candy_price" value='<?= htmlspecialchars($candy["price"]) ?>'>

                        <!-- PART : the card for each products on the page -->
                        <div class="card-body">
                            <h5 class="card-title title-candy"><?= htmlspecialchars($candy["name"]) ?></h5>
                            <p class="card-text text-candy"><?= htmlspecialchars($candy["price"]) ?> €</p>
                            <img class="candy-pic-style" src="./assets/images/candies/<?= $candy["image"] ?>" alt="">


                            <!-- bouton pour ajouter favoris -->
                            <?php if (isset($_SESSION["accountId"])) { ?>
                                <form method="POST" action="index.php?page=<?= $_GET['page'] ?>">
                                    <input type="hidden" name="candy_id" value="<?= $candy["id"] ?>">
                                    <button type="submit" name="add_favorite" class="btn btn-primary">
                                        <img class="svg-candy" src="../assets/images/icon/favorite.svg" alt="">
                                    </button>
                                </form>
                            <?php } ?>

                            <!-- bouton pour ajouter au panier -->
                            <form method="POST" action="index.php?page=<?= $_GET['page'] ?>">
                                <input type="hidden" name="candy_id" value="<?= $candy["id"] ?>">
                                <button type="submit" name="add_to_cart" class="btn btn-secondary">
                                    <img class="svg-candy" src="../assets/images/icon/basket.svg" alt="">
                                </button>
                            </form>

                            <!-- bouton pour afficher le modal et faire apparaître les détails d'un produit -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#candyInfos<?= $candy["id"] ?>">
                                Voir plus
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php } ?>
        </div>
        </div>
</main>