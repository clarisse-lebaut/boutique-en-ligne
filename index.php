<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include_once "./assets/scripts/constants.php";

include_once "./classes/bdd.php";
include_once "./classes/request.php";

session_start();
$request = new Request();

include_once "./assets/components/header.php";

// echo password_hash("laralara", PASSWORD_DEFAULT);
function showAlert(string $message, string $type = "info"): void
{
  echo '<div class="alert alert-' . $type . '" role="alert">' . $message . '</div>';
}

if (!isset($_GET["page"])) {
  $_GET["page"] = PAGE_HOME;
}

switch ($_GET["page"]) {
  case PAGE_HOME: // =======> PAGES
    include "./pages/home.php";
    break;
  case PAGE_CONNECTION:
    include "./pages/connection.php";
    break;
  case CONNECTION: // =======> ACTIONS
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
    break;
  case DISCONNECTION:
    session_destroy();
    header("Location: index.php?page=" . PAGE_HOME);
    break;
  default:
    echo "Error 404";
    break;
}

include_once "./assets/components/footer.php";
