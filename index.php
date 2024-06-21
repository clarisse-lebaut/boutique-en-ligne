<?php
include_once "./classes/bdd.php";
include_once "./classes/request.php";

$request = new Request();

$pageTitle = "Accueil";
header("Location: ./pages/home.php");
