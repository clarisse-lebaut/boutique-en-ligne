<?php
require '../classes/bdd.php';
require '../classes/request.php';
include '../assets/components/header.php';
include '../assets/components/footer.php';

$message = '';
$firstname = '';
$lastname = '';
$email = '';
$adress = '';
$postal_code = '';
if ($_POST) {
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $email = $_POST['email'] ?? '';
    $postal_code = $_POST['postal_code'] ?? '';
    $adress = $_POST['adress'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $role = "User";

    // Conditions de sécurité pour le mot de passe
    $password_min_length = 8;
    $password_has_uppercase = preg_match('@[A-Z]@', $password);
    $password_has_lowercase = preg_match('@[a-z]@', $password);
    $password_has_number = preg_match('@[0-9]@', $password);
    $password_has_special_char = preg_match('@[^\w]@', $password);

    if ($password !== $confirm_password) {
        $message = 'Les mots de passe ne sont pas identique';
    } elseif (strlen($password) < $password_min_length) {
        $message = 'Le mot de passe doit contenir au moins ' . $password_min_length . ' caractères.';
    } elseif (!$password_has_uppercase) {
        $message = 'Le mot de passe doit contenir au moins une lettre majuscule.';
    } elseif (!$password_has_lowercase) {
        $message = 'Le mot de passe doit contenir au moins une lettre minuscule.';
    } elseif (!$password_has_number) {
        $message = 'Le mot de passe doit contenir au moins un chiffre.';
    } elseif (!$password_has_special_char) {
        $message = 'Le mot de passe doit contenir au moins un caractère spécial.';
    } else {
        $request = new Request();
        $result = $request->addUser($firstname, $lastname, $email, $adress, $postal_code, $password);
        $message = $result;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un utilisateur</title>
    <link rel="stylesheet" href="../assets/css/createAccount.css">
    <script src="../assets/script/toggle.js" defer></script>
</head>

<body>
    <h1>Se créer un compte</h1>
    <?php if ($message): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <div class="container box_form">

        <form class="container_form" action="" method="POST">
            <div class="header_section">
                <p>Entrez vos information personnelles</p>
                <hr width="250px">
            </div>
            <section class="top">
                <section class="box_id">
                    <div>
                        <label for="firstname">Nom</label>
                        <input type="text" id="firstname" name="firstname"
                            value="<?php echo htmlspecialchars($firstname); ?>" required>
                    </div>
                    <div>
                        <label for="lastname">Prénom</label>
                        <input type="text" id="lastname" name="lastname"
                            value="<?php echo htmlspecialchars($lastname); ?>" required>
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"
                            required>
                    </div>
                </section>
                <section class="box_location">
                    <div>
                        <label for="adress">Adresse</label>
                        <input type="text" id="adress" name="adress" value="<?php echo htmlspecialchars($adress); ?>"
                            required>
                    </div>
                    <div>
                        <label for="postal_code">Code Postale</label>
                        <input type="number" id="postal_code" name="postal_code"
                            value="<?php echo htmlspecialchars($postal_code); ?>" required>
                    </div>
                </section>
            </section>
            <div class="header_section">
                <p>Faites votre mot de passe</p>
                <hr width="250px">
            </div>
            <section class="bottom">
                <section class="box_psw">
                    <div>
                        <label for="password">Mot de passe</label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" required>
                            <span id="toggle-password" class="input-group-text toggle-password"
                                onclick="togglePassword('password', 'toggle-password')">Voir</span>
                        </div>
                    </div>

                    <div>
                        <label for="confirm_password">Confirmer le mot de passe</label>
                        <div class="input-group">
                            <input type="password" id="confirm_password" name="confirm_password" required>
                            <span id="toggle-confirm-password" class="input-group-text toggle-password"
                                onclick="togglePassword('confirm_password', 'toggle-confirm-password')">Voir</span>
                        </div>
                    </div>
                    <div>
                        <button type="submit">Créer</button>
                    </div>
                </section>
            </section>
            </section>
        </form>

    </div>
    </div>
    <a href="./connection.php">Déjà un compte ? Se connecter</a>
    <a href="./home.php">Revenir à la page d'acceuil</a>
    <!-- <script>
        function togglePassword(fieldId) {
            var field = document.getElementById(fieldId);
            if (field.type === "password") {
                field.type = "text";
            } else {
                field.type = "password";
            }
        }
    </script> -->
</body>

</html>