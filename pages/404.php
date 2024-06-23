<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Erreur 404 - Page non trouvée</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fffafa;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 70px;
            height: 100vh;
            margin: 0;
        }

        h1 {
            font-size: 36px;
        }

        .error {
            background-color: whitesmoke;
            padding: 20px 50px 20px 50px;
            border-radius: 20px;
            box-shadow: 0 0 10px 1px #ffadd9;
            animation: shadow-pulse 2s infinite alternate;
        }

        p {
            font-size: 18px;
        }

        img {
            width: 150px;
        }

        a {
            text-decoration: none;
            color: green;
        }

        a:hover {
            color: red;
        }


        @keyframes shadow-pulse {
            0% {
                box-shadow: 0 0 20px rgba(255, 173, 217, 1);
            }

            100% {
                box-shadow: 0 0 70px rgba(255, 0, 217, 100);
            }
        }
    </style>
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