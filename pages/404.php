<?php
$pageTitle = "404";

// permet d'avoir les couleurs définit dans le global.css
include "../assets/components/header.php";
include "../assets/components/footer.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <link rel="stylesheet" href="../assets/css/404.css">
</head>

<body>
    <img src="../../assets/images/btn/blue-candy.png" alt="">
    <div class="error">
        <h1>Erreur 404</h1>
        <p>😭 Il n'y a aucune sucreries sur cette page ! 😭</p>
        <p>Revenez sur la page<a href="../pages/home.php"> aux 1000 envies </a>!</p>
    </div>
    <img src="../../assets/images/btn/blue-candy.png" alt="">
</body>

</html>