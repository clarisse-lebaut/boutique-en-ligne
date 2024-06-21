<?php
$pageTitle = "Accueil";
include_once "./assets/components/header.php";
?>

<ul>
  <li><a href="./index.php">Accueil</a></li>
  <li>Découvrire les bonbons</li>
  <?php if (!isset($_SESSION["userId"])) { ?>
    <li>Connexion</li>
    <li><a href="./pages/register.php">Créer un compte</a></li>
  <?php } else { ?>
    <li>Profil</li>
    <li>Modifier le profil</li>
    <li>Déconnexion</li>
  <?php } ?>
</ul>

<?php
include_once "./assets/components/footer.php";
?>