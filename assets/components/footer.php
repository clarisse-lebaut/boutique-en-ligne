<section class="footer_container">
    <section class="link">
        <ul class="ul_style">
            <li>Liens utiles</li>
            <div>
                <li><a class="link_style" class="link-style" href="./index.php?page=<?= PAGE_HOME ?>">Accueil</a></li>
                <li><a class="link_style" href="./index.php?page=<?= PAGE_BASKET ?>">Panier</a></li>
                <li><a class="link_style" href="./index.php?page=<?= PAGE_PRODUCTS ?>">Produits</a></li>
                <?php if (!isset($_SESSION["accountId"])) { ?>
                    <li><a class="link_style" href="./index.php?page=<?= PAGE_CONNECTION ?>">Connexion</a></li>
                    <li><a class="link_style" href="./index.php?page=<?= PAGE_REGISTER ?>">Se créer un compte</a></li>
                <?php } else { ?>
                    <li><a class="link_style" href="./index.php?page=<?= PAGE_FAVORITE ?>">Favoris</a></li>
                    <li><a class="link_style" href="./index.php?page=<?= PAGE_PROFILE ?>">Profil</a></li>
                    <li><a class="link_style" href="./index.php?page=<?= DISCONNECTION ?>">Deconnexion</a></li>
                <?php } ?>
            </div>
        </ul>

        <ul class="ul_style">
            <li>Mentions légales</li>
            <div>
                <li>Politique de confidentialités</a></li>
                <li><a class="link_style" href="./index.php?page=<?= PAGE_CONDITIONS ?>">Conditions d'utilisations</a>
                </li>
                <li><a class="link_style" href="./index.php?page=<?= PAGE_ABOUTUS ?>">A propos</a></li>
            </div>
        </ul>
        <ul class="ul_style">
            <li>Contact</li>
            <div>
                <li>123-456-789</a></li>
                <li>n° rue ville code postale</a></li>
                <li>newsletter</a></li>
                <li><a class="link_style" href="./index.php?page=<?= PAGE_CONTACT ?>">Contact</a></li>
            </div>
        </ul>
    </section>
    <section class="logos">
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
    </section>
    <section class="copy">
        <p>&copy; 2024 CandyShop. Tous droits réservés.</p>
    </section>
</section>