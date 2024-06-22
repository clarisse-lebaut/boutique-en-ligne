<?php
$pageTitle = "Accueil";
require '../classes/bdd.php';
require '../classes/request.php';

include "../assets/components/header.php";

// Appelle la fonction pour obtenir les produits
$request = new Request();
$products = $request->getProducts();
$productsDamier = $request->getProductsDamier();

include "../assets/components/footer.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .carousel_style {
            height: 500px;
            background-color: gray;
        }

        .candy_details {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container mb-4">

    </div>

    <a href="./create_account.php">Se créer un compte</a>

    <div class="container mt-4">
        <h1>NOS DERNIERES SORTIES</h1>
        <?php if ($products !== false && count($products) > 0) { ?>
            <div id="productCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $active = 'active';
                    foreach ($products as $row) { ?>
                        <div class="carousel-item <?php echo $active; ?> carousel_style">
                            <div class="d-block w-100 candy_details">
                                <h2><?php echo htmlspecialchars($row["name"]); ?></h2>
                                <p>Price: $<?php echo htmlspecialchars($row["price"]); ?></p>
                            </div>
                        </div>
                        <?php
                        $active = '';
                    } ?>
                </div>
                <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
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
            background-color: blue;
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
        }
    </style>


    <div class="container mt-4">
        <h1>LES PLUS AIMEES</h1>
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
        <div class="container contact-form">
            <form action="process_contact.php" method="POST">
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