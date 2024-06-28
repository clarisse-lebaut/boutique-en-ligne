<!-- favorites.php -->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes favoris</title>
</head>

<body>
    <h1>Mes favoris</h1>

    <div id="favorites-list">
        <!-- Ici seront affichés les favoris -->
    </div>

    <script>
        // JavaScript pour récupérer et afficher les favoris depuis le cookie
        document.addEventListener('DOMContentLoaded', function () {
            const favorites = getFavorite(); // Utilisation de la fonction getFavorite() définie dans votre script précédent

            const favoritesList = document.getElementById('favorites-list');

            if (favorites.length === 0) {
                favoritesList.innerHTML = '<p>Aucun favori pour le moment.</p>';
            } else {
                const ul = document.createElement('ul');

                favorites.forEach(favorite => {
                    const li = document.createElement('li');
                    li.textContent = `${favorite.name} - ${favorite.price} €`;
                    ul.appendChild(li);
                });

                favoritesList.appendChild(ul);
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
    </script>
</body>

</html>