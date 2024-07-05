<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CandyShop</title>

  <link rel="stylesheet" href="./vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
  <script src="./vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js" defer></script>

  <link rel="stylesheet" href="./assets/css/global.css">
  <link rel="stylesheet" href="./assets/css/header.css">
  <link rel="stylesheet" href="./assets/css/footer.css">

  <link rel="stylesheet" href="./assets/css/404.css">
  <link rel="stylesheet" href="./assets/css/home.css">
  <link rel="stylesheet" href="./assets/css/candy.css">
  <link rel="stylesheet" href="./assets/css/basket.css">
  <link rel="stylesheet" href="./assets/css/favorite.css">
  <link rel="stylesheet" href="./assets/css/profil.css">
  <link rel="stylesheet" href="./assets/css/create_account.css">
  <link rel="stylesheet" href="./assets/css/connection.css">
  <link rel="stylesheet" href="./assets/css/contact.css">
</head>

<body>
  <main>
    <nav class="navbar navbar-expand-lg nav-style">
      <div class="container-fluid item-style">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse container-style" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="logo-nav mx-5" href="./index.php?page=<?= PAGE_HOME ?>">HOME</a>
            </li>
            <li class="nav-item">
              <a class="link-style" href="./index.php?page=<?= PAGE_PRODUCTS ?>">Produits</a>
            </li>
            <li class="nav-item">
              <a class="link-style" href="./index.php?page=<?= PAGE_BASKET ?>">Panier</a>
            </li>
            <li class="nav-item">
              <a class="link-style" href="./index.php?page=<?= PAGE_CONTACT ?>">Nous contacter</a>
            </li>

            <li class="nav-item">
              <?php if (!isset($_SESSION["accountId"])) { ?>
              <li><a class="link-style" href="./index.php?page=<?= PAGE_CONNECTION ?>">Connexion</a></li>
              <li><a class="link-style" href="./index.php?page=<?= PAGE_REGISTER ?>">Se créer un compte</a></li>
            <?php } else { ?>
              <li><a class="link-style" href="./index.php?page=<?= PAGE_FAVORITE ?>">Favoris</a></li>
              <li><a class="link-style" href="./index.php?page=<?= PAGE_PROFILE ?>">Profil</a></li>
              <li><a class="link-style" href="./index.php?page=<?= DISCONNECTION ?>">Deconnexion</a></li>
            <?php } ?>
            </li>

          </ul>
        </div>
      </div>
    </nav>
  </main>