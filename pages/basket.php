<body>
    <h1>Votre Panier</h1>

    <div class="text-center m-auto d-flex flex-column justify-content-center align-items-center gap-3">
        <div id="cart-items" class="container m-auto mb-4 mt-4">
            <!-- Contenu du panier sera inséré ici dynamiquement -->
        </div>

        <div id="cart-total">
            Montant total du panier: <span id="total">0.00 €</span>
        </div>

        <button id="clear-cart-btn" class="btn btn-primary" onclick="clearCart()" style="display: none;">Vider le panier</button>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            displayCartItems();
            updateTotal();
        });

        function displayCartItems() {
            const cartItems = getCartFromCookie();
            const cartContainer = document.getElementById('cart-items');
            const clearCartBtn = document.getElementById('clear-cart-btn');
            cartContainer.innerHTML = ''; // Clear previous items

            if (cartItems.length === 0) {
                cartContainer.innerHTML = '<p>Votre panier est vide.</p>';
                clearCartBtn.style.display = 'none'; // Masquer le bouton si le panier est vide
            } else {
                clearCartBtn.style.display = 'block';
                cartItems.forEach(item => {
                    const itemElement = document.createElement('div');
                    itemElement.className = 'card';

                    const contentDiv = document.createElement('div');
                    contentDiv.className = 'card-content';

                    const nameElement = document.createElement('div');
                    nameElement.textContent = `Produit: ${item.name}`;

                    const priceElement = document.createElement('div');
                    priceElement.textContent = `Prix: ${item.price} €`;

                    const quantityElement = document.createElement('div');
                    const quantity = item.quantity !== undefined ? item.quantity : 1;
                    const totalPrice = item.price * quantity;

                    // Utilisation de plusieurs divs pour afficher les lignes l'une en dessous de l'autre
                    const quantityText = document.createElement('div');
                    quantityText.className = 'quantity';
                    quantityText.textContent = `Quantité: ${quantity}`;
                    const totalPriceText = document.createElement('div');
                    totalPriceText.className = 'total';
                    totalPriceText.textContent = `Prix total: ${totalPrice.toFixed(2)} €`;

                    quantityElement.appendChild(quantityText);
                    quantityElement.appendChild(totalPriceText);

                    contentDiv.appendChild(nameElement);
                    contentDiv.appendChild(priceElement);
                    contentDiv.appendChild(quantityElement);

                    // Bouton pour supprimer l'élément du panier
                    const deleteButton = document.createElement('button');
                    deleteButton.textContent = 'x';
                    deleteButton.className = 'deleteP';
                    deleteButton.addEventListener('click', function () {
                        removeFromCart(item.id);
                    });

                    // Actions
                    const actionsDiv = document.createElement('div');
                    actionsDiv.className = 'card-actions';

                    // Bouton pour augmenter la quantité
                    const increaseButton = document.createElement('button');
                    increaseButton.textContent = '+';
                    increaseButton.className = 'add';
                    increaseButton.addEventListener('click', function () {
                        increaseQuantity(item.id);
                    });

                    // Bouton pour diminuer la quantité
                    const decreaseButton = document.createElement('button');
                    decreaseButton.textContent = '-';
                    decreaseButton.className = 'less';
                    decreaseButton.addEventListener('click', function () {
                        decreaseQuantity(item.id);
                    });

                    actionsDiv.appendChild(increaseButton);
                    actionsDiv.appendChild(decreaseButton);

                    itemElement.appendChild(contentDiv);
                    itemElement.appendChild(actionsDiv);
                    itemElement.appendChild(deleteButton); // Ajout du bouton supprimer en haut à droite

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