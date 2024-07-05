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
<!-- laptop version -->
<div class="container mb-4 lastOut-laptop">
    <h2 class="title text-center mt-3 mb-4">Nos dernières sorties</h2>
    <hr>
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
<!-- mobile version -->
<div class="container mb-4 lastOut-mobile">
    <h2 class="title text-center mt-3 mb-4">Nos dernières sorties</h2>
    <hr>
    <div class="container row m-auto">
        <?php
        $counter = 0; // Initialize a counter
        foreach ($products as $row):
            $counter++;
            $class = ($counter % 2 == 0) ? 'card-color-1' : 'card-color-2';
            ?>
            <div class="card d-flex g-3 <?php echo $class; ?>">
                <div class="card-body">
                    <h2><?php echo htmlspecialchars($row["name"]); ?></h2>
                    <p>Prix : $<?php echo htmlspecialchars($row["price"]); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>



<!-- PART : checkerboard to make appeart the most loved products -->
<div class="container-fluid mt-4 loved">
    <div class="container py-4">
        <h2 class="title text-center mt-3 mb-4">Les plus aimées</h2>
        <hr>
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
<div class="container mt-4">
    <div class="container w-100">
        <h2 class="title text-center mt-3 mb-4">Actualitées sucrées</h2>
        <hr>
        <div class="container mb-4 mt-4 ">
            <div class="news">
                <div class="card">
                    <img class="pic" src="../assets/images/news/woke.jpg" alt="">
                    <a href="https://www.bfmtv.com/economie/consommation/m-m-s-renonce-a-ses-mascottes-jugees-woke-par-la-droite-americaine_AD-202301240045.html"
                        target="_blank">Woke par les ricains</a>
                    <time datetime="01/01/1997">01/01/1997</time>
                    <blockquote>20minutes.fr</blockquote>
                    <p class="text-center">actu 1</p>
                </div>
                <div class="card">
                    <img class="pic" src="../assets/images/news/cbd.webp" alt="">
                    <a href="https://www.20minutes.fr/societe/4050765-20230830-bonbons-cbd-contiennent-trop-thc-rappeles-toute-france"
                        target="_blank">CBD dans les bonbons</a>
                    <time datetime="01/01/1997">01/01/1997</time>
                    <blockquote>20minutes.fr</blockquote>
                    <p class="text-center">actu 1</p>
                </div>
                <div class="card">
                    <img class="pic" src="../assets/images/news/inflation.webp" alt="">
                    <a href="https://www.20minutes.fr/economie/4059441-20231025-halloween-prix-bonbons-bondi-21-an-selon-ufc-choisir"
                        target="_blank">Mon dieux que c'est hors de prix</a>
                    <time datetime="01/01/1997">01/01/1997</time>
                    <blockquote>20minutes.fr</blockquote>
                    <p class="text-center">actu 1</p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>