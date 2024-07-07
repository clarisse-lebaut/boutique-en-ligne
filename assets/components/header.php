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
  <link rel="stylesheet" href="./assets/css/modify.css">
  <link rel="stylesheet" href="./assets/css/404.css">
  <link rel="stylesheet" href="./assets/css/home.css">
  <link rel="stylesheet" href="./assets/css/candy.css">
  <link rel="stylesheet" href="./assets/css/basket.css">
  <link rel="stylesheet" href="./assets/css/favorite.css">
  <link rel="stylesheet" href="./assets/css/profil.css">
  <link rel="stylesheet" href="./assets/css/create_account.css">
  <link rel="stylesheet" href="./assets/css/connection.css">
  <link rel="stylesheet" href="./assets/css/contact.css">
  <link rel="stylesheet" href="./assets/css/payment.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg nav-style">
    <div class="container-fluid">
      <a class="navbar-brand logo-nav mx-5" href="./index.php?page=<?= PAGE_HOME ?>">HOME</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse container-style" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="link-style" href="./index.php?page=<?= PAGE_PRODUCTS ?>">Produits</a>
          </li>
          <li class="nav-item">
            <a class="link-style" href="./index.php?page=<?= PAGE_BASKET ?>">Panier</a>
          </li>
          <li class="nav-item">
            <a class="link-style" href="./index.php?page=<?= PAGE_CONTACT ?>">Nous contacter</a>
          </li>
          <?php if (!isset($_SESSION["accountId"])) { ?>
            <li class="nav-item">
              <a class="link-style" href="./index.php?page=<?= PAGE_CONNECTION ?>">Connexion</a>
            </li>
            <li class="nav-item">
              <a class="link-style" href="./index.php?page=<?= PAGE_REGISTER ?>">Se créer un compte</a>
            </li>
          <?php } else { ?>
            <li class="nav-item">
              <a class="link-style" href="./index.php?page=<?= PAGE_FAVORITE ?>">Favoris</a>
            </li>
            <li class="nav-item">
              <a class="link-style" href="./index.php?page=<?= PAGE_PROFILE ?>">Profil</a>
            </li>
            <?php if ($request->getAccountById($_SESSION["accountId"])["role"] == "Admin") { ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Panel d'administration
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="./index.php?page=<?= PAGE_ADMIN_CANDIES ?>">Liste des bonbons</a></li>
                  <li><a class="dropdown-item" href="./index.php?page=<?= PAGE_ADMIN_ADD_CANDIES ?>">Ajouter un bonbon</a>
                  </li>
                  <li><a class="dropdown-item" href="./index.php?page=<?= PAGE_ADMIN_MODIFY_CANDIES ?>">Modifier un
                      bonbon</a></li>
                  <li><a class="dropdown-item" href="./index.php?page=<?= PAGE_ADMIN_DELETE_CANDIES ?>">Supprimer un
                      bonbon</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="./index.php?page=<?= PAGE_ADMIN_CATEGORIES ?>">Liste des catégories</a>
                  </li>
                  <li><a class="dropdown-item" href="./index.php?page=<?= PAGE_ADMIN_ADD_CATEGORIES ?>">Ajouter une
                      catégorie</a></li>
                  <li><a class="dropdown-item" href="./index.php?page=<?= PAGE_ADMIN_MODIFY_CATEGORIES ?>">Modifier une
                      catégorie</a></li>
                  <li><a class="dropdown-item" href="./index.php?page=<?= PAGE_ADMIN_DELETE_CATEGORIES ?>">Supprimer une
                      catégorie</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="./index.php?page=<?= PAGE_ADMIN_USERS ?>">Liste des utilisateurs</a>
                  </li>
                </ul>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a class="link-style" href="./index.php?page=<?= DISCONNECTION ?>">Deconnexion</a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>