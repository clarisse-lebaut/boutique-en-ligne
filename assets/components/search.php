<?php

class SearchForm extends BDD
{
    function __construct()
    {
        parent::__construct();
    }

    public function getSuggestions()
    {
        $query = "SELECT name FROM candy";  // Assurez-vous que 'name' correspond à votre colonne dans la table
        $stmt = $this->connection->query($query);
        $suggestions = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $suggestions[] = $row['name'];  // Utilisez 'name' pour récupérer la suggestion
        }

        return $suggestions;
    }

    public function render()
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <style>
                .candy_shop_pic {
                    width: 250px;
                }
            </style>
        </head>

        <body>
            <div class="container mt-4 logo_search d-flex flex-column">
                <img class="candy_shop_pic m-auto" src="../assets/images/search/candy-shop.png" alt="">
                <div class="search m-auto">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Rechercher" list="suggestions">
                        <datalist id="suggestions">
                            <?php
                            $suggestions = $this->getSuggestions();
                            foreach ($suggestions as $suggestion) {
                                echo "<option value='" . htmlspecialchars($suggestion) . "'>";
                            }
                            ?>
                        </datalist>
                        <button type="button" id="button-addon2" class="btn btn-primary"><img
                                src="../../assets/images/icon/search.svg"></button>
                    </div>
                </div>
            </div>
        </body>

        </html>
        <?php
    }
}
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