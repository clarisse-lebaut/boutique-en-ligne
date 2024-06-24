<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CandyShop</title>

  <link rel="stylesheet" href="./vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
  <script src="./vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js" defer></script>

  <link rel="stylesheet" href="./assets/css/global.css">
</head>

<body>
  <ul>
    <li><a href="./index.php?page=<?= PAGE_HOME ?>">Accueil</a></li>
    <li>Découvrire les bonbons</li>
    <?php if (!isset($_SESSION["accountId"])) { ?>
      <li><a href="./index.php?page=<?= PAGE_CONNECTION ?>">Connexion</a></li>
    <?php } else { ?>
      <li><a>Favoris</a></li>
      <li><a href="index.php?page=<?= PAGE_PROFILE ?>">Profil</a></li>
      <li><a href="index.php?page=<?= DISCONNECTION ?>">Deconnexion</a></li>
    <?php } ?>
  </ul>