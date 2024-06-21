<?php
if (false) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}

include_once "../classes/account.php";

include_once "../classes/bdd.php";
include_once "../classes/request.php";

$request = new Request();

$pageTitle = "Créer un compte";
include_once "../assets/components/header.php";
?>

<main>
  <h1>Créer un compte</h1>

  <form method="post">
    <label for="firstname">Prénom</label>
    <input type="text" name="firstname" id="firstname" required>

    <label for="lastname">Nom de famille</label>
    <input type="text" name="lastname" id="lastname" required>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>

    <label for="confirmationEmail">Email de confirmation</label>
    <input type="email" name="confirmationEmail" id="confirmationEmail" required>

    <label for="confirmationPassword">Mot de passe de confirmation</label>
    <input type="text" name="confirmationPassword" id="confirmationPassword" required>

    <input type="submit" value="S'enregistrer">
  </form>
</main>

<?php
include_once "../assets/components/footer.php";
?>