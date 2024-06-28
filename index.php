<?php
session_start();
require_once "./assets/scripts/constants.php";
require_once "./classes/bdd.php";
require_once "./classes/request.php";
require_once "./enzo-function/candy_class.php";

$request = new Request();
$candy = new Candy();

function showAlert(string $message, string $type = "info"): void
{
    echo '<div class="alert alert-' . $type . '" role="alert">' . $message . '</div>';
}

// Convert numeric page ID to string constant if necessary
if (isset($_GET["page"])) {
    $page_map = [
        PAGE_HOME => PAGE_HOME_STR,
        PAGE_CONNECTION => PAGE_CONNECTION_STR,
        PAGE_PROFILE => PAGE_PROFILE_STR,
        PAGE_MODIFY_PROFILE => PAGE_MODIFY_PROFILE_STR,
        PAGE_REGISTER => PAGE_REGISTER_STR,
        PAGE_BASKET => PAGE_BASKET_STR,
        PAGE_CANDY => PAGE_CANDY_STR,
        PAGE_FAVORITES => PAGE_FAVORITES_STR,
    ];
    
    if (is_numeric($_GET["page"]) && isset($page_map[$_GET["page"]])) {
        $_GET["page"] = $page_map[$_GET["page"]];
    }
} else {
    $_GET["page"] = PAGE_HOME_STR;
}

// Include header
include_once "./assets/components/header.php";

// Main content
try {
    switch ($_GET["page"]) {
        case PAGE_HOME_STR:
            echo '<script src="./assets/script/slider.js" defer></script>';
            echo '<script src="./assets/script/search.js" defer></script>';
            include "./pages/home.php";
            break;
        case PAGE_CONNECTION_STR:
            include "./pages/connection.php";
            break;
        case PAGE_REGISTER_STR:
            include "./pages/create_account.php";
            break;
        case PAGE_BASKET_STR:
            include "./pages/basket.php";
            break;
        case PAGE_PROFILE_STR:
            if (!isset($_SESSION["accountId"])) {
                header("Location: index.php?page=" . PAGE_HOME_STR);
                exit();
            }
            $account = $request->getAccountById($_SESSION["accountId"]);
            include "./pages/profile.php";
            break;
        case PAGE_MODIFY_PROFILE_STR:
            if (!isset($_SESSION["accountId"])) {
                header("Location: index.php?page=" . PAGE_HOME_STR);
                exit();
            }
            $account = $request->getAccountById($_SESSION["accountId"]);
            include "./pages/modify.php";
            break;
        case PAGE_CANDY_STR:
            include "./pages/candy.php";
            break;
        case PAGE_FAVORITES_STR:
            include "./pages/favorites.php";
            break;
        default:
            include "./pages/404.php";
            break;
    }
} catch (Exception $e) {
    showAlert("An error occurred: " . $e->getMessage(), "danger");
}

// Navigation
echo '<nav>';
echo '<a href="index.php?page=' . PAGE_HOME_STR . '">Accueil</a> | ';
echo '<a href="index.php?page=' . PAGE_CANDY_STR . '">Découvrir les bonbons</a> | ';
echo '<a href="index.php?page=' . PAGE_BASKET_STR . '">Panier</a> | ';
if (isset($_SESSION["accountId"])) {
    echo '<a href="index.php?page=' . PAGE_PROFILE_STR . '">Profil</a> | ';
    echo '<a href="index.php?page=' . PAGE_CONNECTION_STR . '&action=' . DISCONNECTION . '">Déconnexion</a>';
} else {
    echo '<a href="index.php?page=' . PAGE_CONNECTION_STR . '">Connexion</a> | ';
    echo '<a href="index.php?page=' . PAGE_REGISTER_STR . '">Se créer un compte</a>';
}
echo '</nav>';

// Include footer
include_once "./assets/components/footer.php";
?>