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

if (!isset($_GET["page"])) {
  $_GET["page"] = PAGE_HOME;
}

switch ($_GET["page"]) {
  case PAGE_HOME:
    include "./pages/home.php";
    break;
  case PAGE_CONNECTION:
    include "./pages/connection.php";
    break;
  case PAGE_REGISTER:
    echo "Register page";
    break;
  case PAGE_PROFILE:
    $account = $request->getAccountById($_SESSION["accountId"]);
    include "./pages/profile.php";
    break;
  case DISCONNECTION:
    session_destroy();
    header("Location: index.php?page=1");
    break;
  default:
    echo "Error 404";
    break;
}

include_once "./assets/components/footer.php";
