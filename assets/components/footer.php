<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CandyShop</title>

    <link rel="stylesheet" href="./vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <script src="./vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js" defer></script>

    <link rel="stylesheet" href="./assets/css/global.css">

    <!-- <link rel="stylesheet" href="./assets/css/404.css">
  <link rel="stylesheet" href="./assets/css/basket.css">
  <link rel="stylesheet" href="./assets/css/checkboard.css">
  <link rel="stylesheet" href="./assets/css/createAccount.css">
  <link rel="stylesheet" href="./assets/css/formContact.css">
  <link rel="stylesheet" href="./assets/css/home.css">
  <link rel="stylesheet" href="./assets/css/slider.css"> -->
</head>

<style>
    .footer_container {
        display: flex;
        flex-direction: column;
        gap: 50px;
        justify-content: center;
    }

    .link {
        display: flex;
        gap: 50px;
    }

    .logos{
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .social {
        display: flex;
        gap: 20px;
    }

    .payment{
        display: flex;
        gap: 20px;
    }

    img {
        width: 40px;
    }
</style>

<section class="footer_container">
    <article class="link">
        <ul>
            <li>Liens utiles</li>
            <li><a href="./index.php?page=<?= PAGE_HOME ?>">Accueil</a></li>
            <li><a href="./index.php?page=<?= PAGE_BASKET ?>">Panier</a></li>
            <li><a href="./index.php?page=<?= PAGE_PRODUCTS ?>">Produits</a></li>
            <?php if (!isset($_SESSION["accountId"])) { ?>
                <li><a href="./index.php?page=<?= PAGE_CONNECTION ?>">Connexion</a></li>
                <li><a href="./index.php?page=<?= PAGE_REGISTER ?>">Se créer un compte</a></li>
            <?php } else { ?>
                <li><a href="./index.php?page=<?= PAGE_FAVORITE ?>">Favoris</a></li>
                <li><a href="./index.php?page=<?= PAGE_PROFILE ?>">Profil</a></li>
                <li><a href="./index.php?page=<?= DISCONNECTION ?>">Deconnexion</a></li>
            <?php } ?>
        </ul>

        <ul>
            <li>Mentions légales</li>
            <li>Politique de confidentialités</a></li>
            <li><a href="./index.php?page=<?= PAGE_CONDITIONS ?>">Conditions d'utilisations</a></li>
            <li><a href="./index.php?page=<?= PAGE_ABOUTUS ?>">A propos</a></li>
        </ul>
        <ul>
            <li>Contact</li>
            <li>123-456-789</a></li>
            <li>n° rue ville code postale</a></li>
            <li>newsletter</a></li>
        </ul>
    </article>
    <article class="logos">
        <div class="social">
            <div class="picture">
                <img src="../assets/images/icon/instagram.svg" alt="">
            </div>
            <div class="picture">
                <img src="../assets/images/icon/whatsapp.svg" alt="">
            </div>
            <div class="picture">
                <img src="../assets/images/icon/x-twitter.svg" alt="">
            </div>
            <div class="picture">
                <img src="../assets/images/icon/tiktok.svg" alt="">
            </div>
            <div class="picture">
                <img src="../assets/images/icon/linkedin.svg" alt="">
            </div>
        </div>
        <div class="payment">
            <div class="picture">
                <img src="../assets/images/icon/cc-paypal.svg" alt="">
            </div>
            <div class="picture">
                <img src="../assets/images/icon/credit-card-regular.svg" alt="">
            </div>
            <div class="picture">
                <img src="../assets/images/icon/credit-card-solid.svg" alt="">
            </div>
        </div>
    </article>
    <article class="copy">
        <p>&copy; 2024 CandyShop. Tous droits réservés.</p>
    </article>
</section>