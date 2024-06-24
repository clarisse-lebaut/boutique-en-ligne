<?php
$pageTitle = "Accueil";
include "../assets/components/header.php";
include "../assets/components/search.php";

require '../classes/bdd.php';
require '../classes/request.php';
// Appelle la fonction pour obtenir les produits
$request = new Request();
$products = $request->getProductsCarousel();
$productsDamier = $request->getProductsCheckerBoard();

include "../assets/components/footer.php";
?>

<script src="../assets/script/slider.js" defer></script>
<script src="../assets/script/search.js" defer></script>

<a href="./create_account.php">Se créer un compte</a>
<a href="./404.php">Test page 404</a>

<?php
// Appelle de classe pour la barre de recherche
$searchForm = new SearchForm();
$searchForm->render();
?>

<style>
    .slider {
        position: relative;
        width: 100%;
        height: 370px;
        display: flex;
    }

    .item {
        position: absolute;
        width: 200px;
        height: 320px;
        text-align: justify;
        border-radius: 10px;
        padding: 20px;
        transition: 0.5s;
        left: calc(50% - 110px);
        top: 0;
        background-color: #ffadd9;
    }

    #next,
    #prev {
        position: absolute;
        top: 30%;
        color: red;
        background-color: transparent;
        border: none;
        font-weight: bold;
        left: 50px;
    }

    #next {
        left: unset;
        right: 50px;
    }

    #prev:hover,
    #next:hover {
        background-color: #ffadd9;
        box-shadow: 0 0 10px 10px #ffadd9;
        border-radius: 100px;
    }

    #prev:active {
        transform: translateX(-20px);
    }

    #next:active {
        transform: translateX(20px);
    }

    .lastout {}

    .loved {
        background-color: #ffffff;
    }

    .news {}
</style>

<div class="container mb-4 lastOut">
    <h1>NOS DERNIERES SORTIES</h1>
    <hr width="250px">
    <?php if ($products !== false && count($products) > 0) { ?>
        <div id="slider_products" class="container mb-4">
            <div class="slider">
                <div class="btn_next">
                    <img id="next" src="../assets/images/btn/orange-candy.png" alt="" width="80px">
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
                    <img id="prev" src="../assets/images/btn/orange-candy.png" alt="" width="80px">
                </div>
            </div>
        </div>
    <?php } else { ?>
        <p>Failed to get products or no products found</p>
    <?php } ?>
</div>
<style>
    .grid-box {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        padding: 10px;
    }

    .card-color-1 {
        background-color: #fffafa;
        /* Couleur 1 */
    }

    .card-color-2 {
        background-color: #ffadd9;
        /* Couleur 2 */
    }

    .card {
        margin: 0;
        /* Évite les marges des cartes */
        height: 250px;
        box-shadow: 5px 5px 5px 1px gray;
        border-radius: 10px;
    }
</style>
<div class="container-fluid mt-4 loved">
    <div class="container py-4">
        <h1>LES PLUS AIMEES</h1>
        <hr width="250px">
        <div class="grid-box">
            <?php
            if ($productsDamier !== false && count($productsDamier) > 0) {
                $index = 0;
                foreach ($productsDamier as $row) {
                    $colorClass = ($index % 2 == 0) ? 'card-color-1' : 'card-color-2';
                    echo "<div class='card $colorClass'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . htmlspecialchars($row["name"]) . "</h5>";
                    echo "<p class='card-text'>Price: $" . htmlspecialchars($row["price"]) . "</p>";
                    echo "</div>";
                    echo "</div>";
                    $index++;
                }
            } else {
                echo "<p>Failed to get products or no products found</p>";
            }
            ?>
        </div>
    </div>
</div>
</div>

<div class="container-fluid mt-4 news">
    <div class="container">
        <h2>Actualité sucrée</h2>
        <hr width="250px">
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../assets/readme/readme.jpeg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="../assets/readme/readme.jpeg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="../assets/readme/readme.jpeg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>
<style>
    .contact-form {
        background: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
        margin-bottom: 20px;
    }
</style>
<div class="container mt-4">
    <h2>Contactez-nous</h2>
    <?php
    if ($_POST) {
        // Récupération des données du formulaire
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $subject = htmlspecialchars($_POST['subject']);
        $message = htmlspecialchars($_POST['message']);

        // Validation simple (vous pouvez ajouter plus de validation)
        if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
            // Traitement des données, par exemple, les enregistrer dans une base de données ou les envoyer par email
            // Pour l'instant, nous allons simplement les afficher
            echo "Nom: " . $name . "<br>";
            echo "Email: " . $email . "<br>";
            echo "Sujet: " . $subject . "<br>";
            echo "Message: " . $message . "<br>";
        } else {
            echo "Données invalides.";
        }
    } else {
        echo "Méthode de requête non autorisée.";
    }
    ?>
    <div class="container contact-form">
        <form action="" method="POST">
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="subject">Sujet</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
</div>
</body>

</html>