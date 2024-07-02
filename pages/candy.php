<?php
// Instanciation de la classe Requete
$requete = new Request();

// Appel de la méthode pour récupérer les catégories
$categories = $requete->getCategories();
$classification = $requete->getClassificationCandy();
?>
<main>
    <h2 class="title text-center mt-3 mb-4">Les douceurs de notre catalogue</h2>
    <hr>

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
        <h3 class="title text-center mt-5 mb-5">Nos produits</h3>

        <div class="product-grid container m-auto">
            <?php if (count($candies) == 0) { ?>
                <div>Pas de bonbon</div>
            <?php } else { ?>
                <?php foreach ($candies as $index => $candy):
                    $colorClass = ($index % 2 == 0) ? 'card-even' : 'card-odd'; // Définir la classe basée sur l'index
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
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
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
                            <?php if (isset($_SESSION["accountId"])) { ?>
                                <button type="button" data-id="<?= $candy["id"] ?>" data-name="<?= $candy["name"] ?>"
                                    data-price="<?= $candy["price"] ?>" class="btn btn-primary add-to-favorites"><img
                                        class="svg-candy" src="../assets/images/icon/favorite.svg" alt=""></button>
                            <?php } ?>
                            <button type="button" class="btn btn-secondary add-to-cart"
                                data-id="<?= htmlspecialchars($candy["id"]) ?>"
                                data-name="<?= htmlspecialchars($candy["name"]) ?>"
                                data-price="<?= htmlspecialchars($candy["price"]) ?>"><img class="svg-candy"
                                    src="../assets/images/icon/basket.svg" alt=""></button>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addToCartButtons = document.querySelectorAll('.add-to-cart');
        const addToFavoritesButtons = document.querySelectorAll(".add-to-favorites");

        addToCartButtons.forEach(button => {
            button.addEventListener('click', async function () {
                const candyId = this.dataset.id;
                const candyName = this.dataset.name;
                const candyPrice = this.dataset.price;

                // Ajouter le produit au panier avec ID, nom et prix
                addToCart({ id: candyId, name: candyName, price: candyPrice });

                // Simuler une requête réseau asynchrone pour ajouter le produit au panier
                try {
                    const response = await fetch('/pages/candy.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ id: candyId, name: candyName, price: candyPrice })
                    });

                    if (response.ok) {
                        // Afficher un message de succès
                        alert(`${candyName} a été ajouté au panier !`);
                    } else {
                        // Gérer les erreurs de la réponse
                        alert(`Erreur lors de l'ajout de ${candyName} au panier.`);
                    }
                } catch (error) {
                    // Gérer les erreurs de la requête
                    alert(`Erreur réseau lors de l'ajout de ${candyName} au panier.`);
                }
            });
        });

        function addToCart(product) {
            const cart = getCart();
            // Vérifier si le produit est déjà dans le panier en fonction de l'ID
            const existingProductIndex = cart.findIndex(item => item.id === product.id);

            if (existingProductIndex !== -1) {
                // Si le produit existe déjà, augmenter la quantité ou gérer comme nécessaire
                // Par exemple, ici, nous n'ajoutons qu'une seule fois le même produit
                alert(`${product.name} est déjà dans le panier.`);
                return;
            }

            // Ajouter le produit au panier
            cart.push(product);

            // Mettre à jour le cookie avec le panier mis à jour
            document.cookie = `cart=${JSON.stringify(cart)}; path=/;`;
        }

        function getCart() {
            const cookies = document.cookie.split(';').map(cookie => cookie.trim());
            const cartCookie = cookies.find(cookie => cookie.startsWith('cart='));
            if (cartCookie) {
                return JSON.parse(cartCookie.split('=')[1]);
            }
            return [];
        }

        // FAVORITE PART
        addToFavoritesButtons.forEach(button => {
            button.addEventListener('click', async function () {
                const candyId = this.dataset.id;
                const candyName = this.dataset.name;
                const candyPrice = this.dataset.price;

                // Ajouter le produit au panier avec ID, nom et prix
                addToFavorites({ id: candyId, name: candyName, price: candyPrice });

                // Simuler une requête réseau asynchrone pour ajouter le produit au panier
                try {
                    const response = await fetch('/pages/candy.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ id: candyId, name: candyName, price: candyPrice })
                    });

                    if (response.ok) {
                        // Afficher un message de succès
                        alert(`${candyName} a été ajouté aux favoris !`);
                    } else {
                        // Gérer les erreurs de la réponse
                        alert(`Erreur lors de l'ajout de ${candyName} aux favoris.`);
                    }
                } catch (error) {
                    // Gérer les erreurs de la requête
                    alert(`Erreur réseau lors de l'ajout de ${candyName} aux favoris.`);
                }
            });
        });

        function addToFavorites(product) {
            const favorite = getFavorite();
            // Vérifier si le produit est déjà dans le panier en fonction de l'ID
            const existingProductIndex = favorite.findIndex(item => item.id === product.id);

            if (existingProductIndex !== -1) {
                // Si le produit existe déjà, augmenter la quantité ou gérer comme nécessaire
                // Par exemple, ici, nous n'ajoutons qu'une seule fois le même produit
                alert(`${product.name} est déjà dans les favoris.`);
                return;
            }

            // Ajouter le produit aux favoris
            favorite.push(product);

            // Mettre à jour le cookie avec les favoris mis à jour
            document.cookie = `favorite=${JSON.stringify(favorite)}; path=/;`;
        }

        function getFavorite() {
            const cookies = document.cookie.split(';').map(cookie => cookie.trim());
            const favoritesCookie = cookies.find(cookie => cookie.startsWith('favorite='));
            if (favoritesCookie) {
                return JSON.parse(favoritesCookie.split('=')[1]);
            }
            return [];
        }
    });
</script>