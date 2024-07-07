<?php
$requete = new Request();
$cart = [];

// Delete a prodcut frome the basket
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove'])) {
    $candyIdToRemove = $_POST['candyId'];
    if (($key = array_search($candyIdToRemove, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

// Check if a basket is present in the session
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $candyId) {
        $candy = $requete->getCandyById($candyId);
        if ($candy) {
            $cart[] = $candy;
        }
    }
}

$total = 0;
?>

<main>
    <h2 class="title text-center mt-3 mb-4">Votre Panier</h2>
    <hr>
    <div class="product-box container m-auto mt-4">
        <div class="card-box">
            <?php if (count($cart) == 0) { ?>
                <div>Le panier est vide.</div>
            <?php } else { ?>
                <?php foreach ($cart as $key => $candy): ?>
                    <?php
                    $subtotal = $candy["price"] * 1;
                    $total += $subtotal;
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
                                        <p>Soyez le premier à donner votre avis !</p>
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
                                    <div class="modal-footer">
                                        <!-- button to add at the favorite -->
                                        <?php if (isset($_SESSION["accountId"])) { ?>
                                            <a href="index.php?page=<?= $_GET['page'] ?>&action=add_favorite&candy_id=<?= $candy["id"] ?>"
                                                class="btn btn-primary">
                                                <img class="svg-candy" src="../assets/images/icon/favorite.svg" alt="">
                                            </a>
                                        <?php } ?>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card container m-auto card-container <?php echo $key % 2 == 0 ? 'even' : 'odd'; ?>">
                        <div class="card-body">
                            <h5 class="card-title title-candy"><?= htmlspecialchars($candy["name"]) ?></h5>
                            <p class="card-text text-candy"><?= htmlspecialchars($candy["price"]) ?> €</p>
                            <img class="candy-pic-style" src="./assets/images/candies/<?= $candy["image"] ?>" alt="">
                            <form method="post" action="">
                                <input type="hidden" name="candyId" value="<?= $candy['id'] ?>">
                                <div style="display:flex; flex-direction:column;">
                                    <label for="quantity">Quantité : </label>
                                    <input type="number" name="quantity" value="1" min="1">
                                    <button type="submit" name="update" class="btn btn-primary">Mettre à jour</button>
                                    <button type="submit" name="remove" class="btn btn-danger">Supprimer</button>
                                    <!-- button to make appear the modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#candyInfos<?= $candy["id"] ?>">
                                        Voir plus
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div>
                <div class="text-center total-container">
                    <p>Total : <?= htmlspecialchars($total) ?> €</p>
                </div>
            </div>
            <?php
            // Get the amount on the session
            $_SESSION['total'] = $total;
            ?>
        <?php } ?>
        <?php if (isset($_SESSION["accountId"])) { ?>
            <a href="./index?page=<?= PAGE_PAYEMENT ?>">Passer la commande</a>
        <?php } else { ?>
            <a href="./index?page=<?= PAGE_CONNECTION ?>">Passer la commande</a>
        <?php } ?>
    </div>
</main>