<?php
include_once "./classes/bdd.php";
include_once "./classes/request.php";

$request = new Request();

$pageTitle = "Accueil";
include_once "./assets/components/header.php";
?>

<?php
include_once "./assets/components/footer.php";
?>