<?php
function showAlert(string $message, string $type = "info"): void
{
  echo '<div class="alert alert-' . $type . '" role="alert">' . $message . '</div>';
}

// Go to the home page when the user is already connected
if (isset($_SESSION["accountId"])) {
  header("Location: index.php?page=1");
}

// When the btnConnect button is clicked
if (isset($_POST["btnConnect"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];

  // If account doesn't exist with that email
  if ($request->isAccountExist($email) == false) {
    showAlert("Le compte n'existe pas !", "danger");
    return;
  }

  // If the password passed in the input doesn't match with the password under the database
  if ($request->isPasswordValid($email, $password) == false) {
    showAlert("Le mot de passe n'est pas valide !", "danger");
    return;
  }

  $account = $request->getAccount($email);

  $_SESSION["accountId"] = $account["id"];
  header("Location: index.php?page=1");
}
?>

<main>
  <h1>Connexion</h1>

  <form action="#" method="post">
    <label for="email">Email</label>
    <input type="email" name="email" id="email">

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" minlength="8">

    <input type="submit" class="btn btn-primary" name="btnConnect" value="Se connecter">
    <a href="index.php?page=<?= PAGE_REGISTER ?>">S'inscrire</a>
  </form>
</main>