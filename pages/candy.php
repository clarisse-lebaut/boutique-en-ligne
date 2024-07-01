<?php
// Instanciation de la classe Requete
$requete = new Request();

// Appel de la méthode pour récupérer les catégories
$categories = $requete->getCategoryCandy();
$classification = $requete->getClassificationCandy();
?>

<main>
    <h2 class="title text-center mt-3 mb-4">Les douceurs de notre catalogue</h2>
    <hr>

    <div class="container">
        <div class="text-center mt-5">Filtres</div>
        <div class="filter-bar mt-3">
            <?php foreach ($categories as $category): ?>
                <button class="category-button" data-category-id="<?php echo htmlspecialchars($category['id']); ?>">
                    <?php echo htmlspecialchars($category['name']); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <h1>Nos produits</h1>

        <div class="product-grid container m-auto">
            <?php if (count($candies) == 0) { ?>
                <div>Pas de bonbon</div>
            <?php } else { ?>
                <?php foreach ($candies as $index => $candy):
                    $colorClass = ($index % 2 == 0) ? 'card-even' : 'card-odd'; // Définir la classe basée sur l'index
                    ?>
                    <div class="card <?= $colorClass ?> container m-auto card-container">
                        <input type="hidden" name="candy" value='<?= $candy["id"] ?>'>
                        <input class="name" type="hidden" name="candy_name" value='<?= htmlspecialchars($candy["name"]) ?>'>
                        <input class="price" type="hidden" name="candy_price" value='<?= htmlspecialchars($candy["price"]) ?>'>

                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($candy["name"]) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($candy["price"]) ?> €</p>
                            <button type="button" data-id="<?= $candy["id"] ?>" data-name="<?= $candy["name"] ?>"
                                data-price="<?= $candy["price"] ?>" class="btn btn-primary add-to-favorites"><img
                                    src="../assets/images/icon/favorite.svg" alt=""></button>
                            <button type="button" class="btn btn-secondary add-to-cart"
                                data-id="<?= htmlspecialchars($candy["id"]) ?>"
                                data-name="<?= htmlspecialchars($candy["name"]) ?>"
                                data-price="<?= htmlspecialchars($candy["price"]) ?>"><img
                                    src="../assets/images/icon/basket.svg" alt=""></button>
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