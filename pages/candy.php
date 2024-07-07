<?php
$requete = new Request();
$categories = $requete->getCategories();
$classification = $requete->getClassificationCandy();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    $action = $_GET['action'];
    $candyId = $_GET['candy_id'];

    if ($action === 'add_favorite') {
        if (!isset($_SESSION['favorites'])) {
            $_SESSION['favorites'] = [];
        }

        if (!in_array($candyId, $_SESSION['favorites'])) {
            $_SESSION['favorites'][] = $candyId;
        }

    } elseif ($action === 'add_to_cart') {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (!in_array($candyId, $_SESSION['cart'])) {
            $_SESSION['cart'][] = $candyId;
        }
    }
}
?>
<main>
    <h2 class="title text-center mt-3 mb-4">Les douceurs de notre catalogue</h2>
    <hr>

    <h3 class="container">
        <h3 class="title text-center mt-3 mb-4">Filtres</h3>
        <form class="filter-form" type="submit" action="index.php?page=<?= FILTER_PRODUCTS ?>" method="POST">
            <select class="filter" name="sltFilter">
                <option class="option-filter" value="all">Afficher tous les produits</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category["id"] ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                <?php endforeach; ?>
            </select>
            <input class="btn btn-primary shadow input-filter" type="submit" name="btnFilter" value="Filtrer">
        </form>

        <h3 class="title text-center mt-5 mb-5">Nos produits</h3>
        <div class="product-grid container m-auto">
            <?php if (count($candies) == 0) { ?>
                <div>Pas de bonbon</div>
            <?php } else { ?>
                <?php foreach ($candies as $index => $candy):
                    $colorClass = ($index % 2 == 0) ? 'card-even' : 'card-odd';
                    ?>
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

                                    <!-- button to add to the basket -->
                                    <a href="index.php?page=<?= $_GET['page'] ?>&action=add_to_cart&candy_id=<?= $candy["id"] ?>"
                                        class="btn btn-secondary">
                                        <img class="svg-candy" src="../assets/images/icon/basket.svg" alt="">
                                    </a>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card <?= $colorClass ?> container m-auto card-container">
                        <input type="hidden" name="candy" value='<?= $candy["id"] ?>'>
                        <input class="name" type="hidden" name="candy_name" value='<?= htmlspecialchars($candy["name"]) ?>'>
                        <input class="price" type="hidden" name="candy_price" value='<?= htmlspecialchars($candy["price"]) ?>'>

                        <div class="card-body">
                            <h5 class="card-title title-candy"><?= htmlspecialchars($candy["name"]) ?></h5>
                            <p class="card-text text-candy"><?= htmlspecialchars($candy["price"]) ?> €</p>
                            <img class="candy-pic-style" src="./assets/images/candies/<?= $candy["image"] ?>" alt="">

                            <!-- bouton pour ajouter favoris -->
                            <?php if (isset($_SESSION["accountId"])) { ?>
                                <a href="index.php?page=<?= $_GET['page'] ?>&action=add_favorite&candy_id=<?= $candy["id"] ?>"
                                    class="btn btn-primary">
                                    <img class="svg-candy" src="../assets/images/icon/favorite.svg" alt="">
                                </a>
                            <?php } ?>

                            <!-- button to add at the faovrites -->
                            <a href="index.php?page=<?= $_GET['page'] ?>&action=add_to_cart&candy_id=<?= $candy["id"] ?>"
                                class="btn btn-secondary">
                                <img class="svg-candy" src="../assets/images/icon/basket.svg" alt="">
                            </a>

                            <!-- button to make appear the modal -->
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