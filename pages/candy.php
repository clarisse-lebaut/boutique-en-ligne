<?php
// Instanciation de la classe Requete
$requete = new Request();

// Appel de la méthode pour récupérer les catégories
$categories = $requete->getCategoryCandy();
$classification = $requete->getClassificationCandy();
?>

<main>
    <h1>Nos produits</h1>
    <h1>Catégories de Bonbons</h1>
    <div class="filter-bar">
        <?php foreach ($categories as $category): ?>
            <button class="category-button" data-category-id="<?php echo htmlspecialchars($category['id']); ?>">
                <?php echo htmlspecialchars($category['name']); ?>
            </button>
        <?php endforeach; ?>
    </div>
    
    <style>
        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin: 50px;
        }
    </style>
    <h1>Nos produits</h1>
    <?php if (count($candies) == 0) { ?>
        <div>Pas de bonbon</div>
        <?php
    } else {
        foreach ($candies as $candy) {
            ?>
            <input type="hidden" name="candy" value='<?= $candy["id"] ?>'>
            <input type="hidden" name="candy_name" value='<?= htmlspecialchars($candy["name"]) ?>'>
            <input type="hidden" name="candy_price" value='<?= htmlspecialchars($candy["price"]) ?>'>

            <?= $candy["name"] ?> - <?= $candy["price"] ?> €

            <button type="button" data-id="<?= $candy["id"] ?>" data-name="<?= $candy["name"] ?>"
                data-price="<?= $candy["price"] ?>" class="add-to-favorites">Ajouter au favoris</button>

            <button type="button" class="btn btn-secondary add-to-cart" data-id="<?= htmlspecialchars($candy["id"]) ?>"
                data-name="<?= htmlspecialchars($candy["name"]) ?>"
                data-price="<?= htmlspecialchars($candy["price"]) ?>">Ajouter au panier</button>
            <?php
        }
    }
    ?>
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

        function addToFavorites(product) {
            const favorite = getFavorite();
            // Vérifier si le produit est déjà dans le panier en fonction de l'ID
            const existingProductIndex = favorite.findIndex(item => item.id === product.id);

            if (existingProductIndex !== -1) {
                // Si le produit existe déjà, augmenter la quantité ou gérer comme nécessaire
                // Par exemple, ici, nous n'ajoutons qu'une seule fois le même produit
                alert(`${product.name} est déjà dans le panier.`);
                return;
            }

            // Ajouter le produit au panier
            favorite.push(product);

            // Mettre à jour le cookie avec le panier mis à jour
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