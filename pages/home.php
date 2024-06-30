<!-- import class and fonction -->
<?php
$pageTitle = "Accueil";
include "./assets/components/search.php";
// Appelle la fonction pour obtenir les produits
$request = new Request();
$products = $request->getProductsCarousel();
$productsDamier = $request->getProductsCheckerBoard();
// Appelle la classe de la barre de recherche
$searchForm = new SearchForm();
?>

<?php
$searchForm->render();
?>

<!-- PART : to make appear the name of the connected user -->
<h1 class="user-name">
    <?php
    // Condition pour vérifier si une session est en cour
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // Fucntion to check if an user is connected
    function isLoggedIn()
    {
        return isset($_SESSION['accountId']);
    }
    // Exécution conditionnelle en fonction de l'état de connexion
    if (isLoggedIn()) {
        $account = $request->getAccountById($_SESSION["accountId"]);

        // Action à prendre si l'utilisateur est connecté
        echo "Quelle sera votre péché " . $account['firstname'] . " ?";
        // Ajoutez ici les actions que vous souhaitez prendre si l'utilisateur est connecté
    } else {
        // Action à prendre si l'utilisateur n'est pas connecté
        echo "Bienvenue dans un monde de pur merveille";
        // Ajoutez ici les actions que vous souhaitez prendre si l'utilisateur n'est pas connecté
    }
    ?>
</h1>

<!-- PART : slider to make appear the last add products -->
<div class="container mb-4 lastOut">
    <h1>NOS DERNIERES SORTIES</h1>
    <hr width="250px" style="margin-bottom:100px;">
    <?php if ($products !== false && count($products) > 0) { ?>
        <div id="slider_products" class="container mb-4">
            <div class="slider">
                <div class="btn_next">
                    <img id="next" src="./assets/images/btn/orange-candy.png" alt="" width="80px">
                </div>
                <?php
                $active = 'active';
                foreach ($products as $row) { ?>
                    <div class="item <?php echo $active; ?>">
                        <h2><?php echo htmlspecialchars($row["name"]); ?></h2>
                        <p>Price: $<?php echo htmlspecialchars($row["price"]); ?></p>
                    </div>
                    <?php
                    $active = '';
                } ?>
                <div class="btn_prev">
                    <img id="prev" src="./assets/images/btn/orange-candy.png" alt="" width="80px">
                </div>
            </div>
        </div>
    <?php } else { ?>
        <p>Failed to get products or no products found</p>
    <?php } ?>
</div>

<!-- PART : checkerboard to make appeart the most loved products -->
<div class="container-fluid mt-4 loved">
    <div class="container py-4">
        <h1>LES PLUS AIMEES</h1>
        <hr width="250px">
        <div class="grid-box">
            <?php if ($productsDamier !== false && count($productsDamier) > 0): ?>
                <?php $index = 0; ?>
                <?php foreach ($productsDamier as $row): ?>
                    <?php $colorClass = ($index % 2 == 0) ? 'card-color-1' : 'card-color-2'; ?>
                    <div class=" card_style <?php echo $colorClass; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row["name"]); ?></h5>
                            <p class="card-text">Price: $<?php echo htmlspecialchars($row["price"]); ?></p>
                        </div>
                    </div>
                    <?php $index++; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Failed to get products or no products found</p>
            <?php endif; ?>
        </div>
    </div>
</div>



<!-- PART :carousel to make appeart the last news -->
<style>
    .pic {
        width: 100%;
    }
</style>
<div class="container mt-4 news">
    <div class="container">
        <h2>ACTUALITEES SUCREES</h2>
        <hr width="250px">
        <div class="container">
            <div class="d-flex gap-5">
                <div class="card">
                    <img class="pic" src="../assets/readme/readme.jpeg" alt="">
                    <p class="text-center">actu 1</p>
                </div>
                <div class="card">
                    <img class="pic" src="../assets/readme/readme.jpeg" alt="">
                    <p class="text-center">actu 1</p>
                </div>
                <div class="card">
                    <img class="pic" src="../assets/readme/readme.jpeg" alt="">
                    <p class="text-center">actu 1</p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>