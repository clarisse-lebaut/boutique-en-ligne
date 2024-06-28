<!-- panier.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Panier</title>
    <!-- Inclure vos styles CSS ou Bootstrap ici -->
</head>

<body>
    <h1>Votre Panier</h1>

    <div id="cart-items">
        <!-- Contenu du panier sera inséré ici dynamiquement -->
    </div>

    <div id="cart-total">
        Montant total du panier: <span id="total">0.00 €</span>
    </div>

    <button onclick="clearCart()">Vider le panier</button>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            displayCartItems();
            updateTotal();
        });

        function displayCartItems() {
            const cartItems = getCartFromCookie();
            const cartContainer = document.getElementById('cart-items');
            cartContainer.innerHTML = ''; // Clear previous items

            if (cartItems.length === 0) {
                cartContainer.innerHTML = '<p>Votre panier est vide.</p>';
            } else {
                cartItems.forEach(item => {
                    const itemElement = document.createElement('div');
                    const quantity = item.quantity !== undefined ? item.quantity : 1;
                    const totalPrice = item.price * quantity; // Calcul du prix total pour cet article
                    itemElement.textContent = `${item.name} - ${item.price} € (Quantité: ${quantity}, Prix total: ${totalPrice.toFixed(2)} €)`;

                    // Bouton pour supprimer l'élément du panier
                    const deleteButton = document.createElement('button');
                    deleteButton.textContent = 'Supprimer';
                    deleteButton.addEventListener('click', function () {
                        removeFromCart(item.id);
                    });
                    itemElement.appendChild(deleteButton);

                    // Bouton pour augmenter la quantité
                    const increaseButton = document.createElement('button');
                    increaseButton.textContent = '+';
                    increaseButton.addEventListener('click', function () {
                        increaseQuantity(item.id);
                    });
                    itemElement.appendChild(increaseButton);

                    // Bouton pour diminuer la quantité
                    const decreaseButton = document.createElement('button');
                    decreaseButton.textContent = '-';
                    decreaseButton.addEventListener('click', function () {
                        decreaseQuantity(item.id);
                    });
                    itemElement.appendChild(decreaseButton);

                    cartContainer.appendChild(itemElement);
                });
            }
        }

        function clearCart() {
            // Effacez le cookie 'cart' pour vider le panier
            document.cookie = 'cart=; Max-Age=-1; path=/';
            displayCartItems(); // Actualiser l'affichage du panier
            updateTotal(); // Actualiser le montant total
        }

        function removeFromCart(productId) {
            let cart = getCartFromCookie();
            cart = cart.filter(item => item.id !== productId);
            document.cookie = `cart=${JSON.stringify(cart)}; path=/;`;
            displayCartItems(); // Actualiser l'affichage du panier
            updateTotal(); // Actualiser le montant total
        }

        function increaseQuantity(productId) {
            let cart = getCartFromCookie();
            const index = cart.findIndex(item => item.id === productId);
            if (index !== -1) {
                cart[index].quantity = cart[index].quantity ? cart[index].quantity + 1 : 2;
            }
            document.cookie = `cart=${JSON.stringify(cart)}; path=/;`;
            displayCartItems(); // Actualiser l'affichage du panier
            updateTotal(); // Actualiser le montant total
        }

        function decreaseQuantity(productId) {
            let cart = getCartFromCookie();
            const index = cart.findIndex(item => item.id === productId);
            if (index !== -1 && cart[index].quantity > 1) {
                cart[index].quantity--;
            }
            document.cookie = `cart=${JSON.stringify(cart)}; path=/;`;
            displayCartItems(); // Actualiser l'affichage du panier
            updateTotal(); // Actualiser le montant total
        }

        function updateTotal() {
            const cartItems = getCartFromCookie();
            let total = 0;
            cartItems.forEach(item => {
                const quantity = item.quantity !== undefined ? item.quantity : 1;
                total += item.price * quantity;
            });
            document.getElementById('total').textContent = `${total.toFixed(2)} €`;
        }

        function getCartFromCookie() {
            const cookies = document.cookie.split(';').map(cookie => cookie.trim());
            const cartCookie = cookies.find(cookie => cookie.startsWith('cart='));
            if (cartCookie) {
                return JSON.parse(cartCookie.split('=')[1]);
            }
            return [];
        }
    </script>
</body>

</html>