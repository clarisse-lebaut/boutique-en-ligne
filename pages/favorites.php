<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favoris</title>
    <style>

    </style>
</head>

<body>
    <h2 class="title text-center mt-3 mb-4">Retrouvez vos coups de coeur !</h2>
    <hr>
    <div class="container m-auto">
        <div id="favorites-list" class="m-auto mt-3">
            <!-- Ici seront affichés les favoris -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const favorites = getFavorite();

            const favoritesList = document.getElementById('favorites-list');

            if (favorites.length === 0) {
                favoritesList.innerHTML = '<p>Aucun favori pour le moment.</p>';
            } else {
                favorites.forEach((favorite, index) => {
                    const card = document.createElement('div');
                    card.className = 'favorite-card';

                    if (index % 2 === 0) {
                        card.classList.add('even');
                    } else {
                        card.classList.add('odd');
                    }

                    const content = document.createElement('div');
                    content.className = 'favorite-content';

                    const name = document.createElement('div');
                    name.textContent = favorite.name;

                    const price = document.createElement('div');
                    price.textContent = `${favorite.price} €`;

                    content.appendChild(name);
                    content.appendChild(price);

                    // Bouton pour supprimer l'article
                    const deleteButton = document.createElement('button');
                    deleteButton.className = 'delete-button';
                    // Créer une balise img pour le bouton supprimer
                    const deleteImg = document.createElement('img');
                    deleteImg.className = 'svgFavorite';
                    deleteImg.src = '../assets/images/icon/delete.svg'; // Notez que l'image pour supprimer devrait être différente
                    // Ajouter l'image au bouton supprimer
                    deleteButton.appendChild(deleteImg);
                    deleteButton.addEventListener('click', function () {
                        deleteFavorite(index);
                    });

                    card.appendChild(content);
                    card.appendChild(deleteButton);
                    favoritesList.appendChild(card);
                });
            }
        });

        function getFavorite() {
            const cookies = document.cookie.split(';').map(cookie => cookie.trim());
            const favoritesCookie = cookies.find(cookie => cookie.startsWith('favorite='));
            if (favoritesCookie) {
                return JSON.parse(favoritesCookie.split('=')[1]);
            }
            return [];
        }

        function setFavorite(favorites) {
            document.cookie = `favorite=${JSON.stringify(favorites)}; path=/;`;
        }

        function deleteFavorite(index) {
            const favorites = getFavorite();
            favorites.splice(index, 1);
            setFavorite(favorites);
            location.reload(); // Recharger la page pour mettre à jour la liste des favoris
        }
    </script>
</body>

</html>