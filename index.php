<?php
if (false) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}

include_once "./classes/account.php";

include_once "./classes/bdd.php";
include_once "./classes/request.php";

$request = new Request();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CandyShop</title>

  <link rel="stylesheet" href="./vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
  <script src="./vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js" defer></script>

  <link rel="stylesheet" href="./assets/css/global.css">
</head>

<body>
</body>

</html>