<?php
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
    echo '<script src="./assets/script/slider.js" defer></script>';
    echo '<script src="./assets/script/search.js" defer></script>';
    include "./pages/home.php";
    break;
  case PAGE_CONNECTION:
    include "./pages/connection.php";
    break;
  case PAGE_REGISTER:
    include "./pages/create_account.php";
    break;
  case PAGE_CONDITIONS:
    include "./pages/create_account.php";
    break;
  case PAGE_ABOUTUS:
    include "./pages/create_account.php";
    break;
  case PAGE_PRODUCTS:
    $candies = $request->getAllCandies();
    $favorites = json_decode($_COOKIE["favorite" . $_SESSION["accountId"]]);
    include "./pages/candy.php";
    break;
  case PAGE_BASKET:
    include "./pages/basket.php";
    break;
  case PAGE_FAVORITE:
    $favorite = json_decode($_COOKIE["favorite" . $_SESSION["accountId"]]);
    include "./pages/favorites.php";
    break;
  case PAGE_PROFILE:
    if (!isset($_SESSION["accountId"])) {
      header("Location: index.php?page=" . PAGE_HOME);
    }

    $account = $request->getAccountById($_SESSION["accountId"]);
    include "./pages/profile.php";
    break;
  case PAGE_MODIFY_PROFILE:
    if (!isset($_SESSION["accountId"])) {
      header("Location: index.php?page=" . PAGE_HOME);
    }

    $account = $request->getAccountById($_SESSION["accountId"]);
    include "./pages/modify.php";
    break;
  case CONNECTION: // =======> ACTIONS
    // Go to the home page when the user is already connected
    if (isset($_SESSION["accountId"])) {
      header("Location: index.php?page=" . PAGE_HOME);
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

      if (isset($_COOKIE["favorite" . $_SESSION["accountId"]]) == false) {
        setcookie("favorite" . $_SESSION["accountId"], json_encode([]));
      }

      header("Location: index.php?page=1");
    }
    break;
  case DISCONNECTION:
    session_destroy();
    header("Location: index.php?page=" . PAGE_HOME);
    break;
  case MODIFICATION_OF_PROFILE:
    $account = $request->getAccountById($_SESSION["accountId"]);

    # Empty checking to avoid data to be empty
    $newFirstname = empty($_POST["firstname"]) ? $account["firstname"] : $_POST["firstname"];
    $newLastname = empty($_POST["lastname"]) ? $account["lastname"] : $_POST["lastname"];
    $newAddress = empty($_POST["address"]) ? $account["address"] : $_POST["address"];
    $newZipcode = empty($_POST["zipcode"]) ? $account["zipcode"] : $_POST["zipcode"];
    $newEmail = empty($_POST["email"]) ? $account["email"] : $_POST["email"];

    $newPassword = $account["password"];
    if (empty($_POST["oldPassword"]) == false && empty($_POST["newPassword"]) == false) {
      if (password_verify($_POST["oldPassword"], $account["password"]) == false) {
        showAlert("L'ancien mot de passe ne correspond pas au mot de passe du compte !", "danger");
        return;
      }

      if ($_POST["newPassword"] != $_POST["newPasswordConfirmation"]) {
        showAlert("Le nouveau mot de passe et le nouveau mot de passe de confirmation ne correspond pas entre eux !", "danger");
        return;
      }

      $newPassword = password_hash($_POST["newPassword"], PASSWORD_DEFAULT);
    }

    $request->updateAccount($account["id"], $newFirstname, $newLastname, $newAddress, $newZipcode, $newEmail, $newPassword);
    header("Location: index.php?page=" . PAGE_PROFILE);
    break;
  case ADD_FAVORITES:
    $favorites = json_decode($_COOKIE["favorite" . $_SESSION["accountId"]]);
    $candy = $request->getCandyById($_POST["candy"]);

    if (isset($_POST["removeFavorite"])) {
      if (in_array($candy, $favorites)) {
        array_splice($favorites, array_search($candy, $favorites) - 1, 1);
        setcookie($_COOKIE["favorite" . $_SESSION["accountId"]], json_encode($favorites));
      }

      // header("Location: index.php?page=" . PAGE_PRODUCTS);
    }

    if (isset($_POST["addFavorite"])) {
      var_dump(in_array($candy, $favorites) == false);
      if (in_array($candy, $favorites) == false) {
        array_push($favorites, $candy);
        setcookie($_COOKIE["favorite" . $_SESSION["accountId"]], json_encode($favorites));
      }

      // header("Location: index.php?page=" . PAGE_PRODUCTS);
    }
    break;
  default:
    include "./pages/404.php";
    break;
}

include_once "./assets/components/footer.php";
