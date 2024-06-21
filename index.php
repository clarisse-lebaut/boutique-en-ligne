<?php
include_once "./classes/account.php";
include_once "./classes/bdd.php";
include_once "./classes/request.php";

$request = new Request();

$pageTitle = "";
header("Location: ./pages/home.php");
