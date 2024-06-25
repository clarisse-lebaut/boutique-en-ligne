<?php
require '../classes/bdd.php';
require '../classes/request.php';

$message = '';
$firstname = '';
$lastname = '';
$email = '';
if ($_POST) {
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $email = $_POST['email'] ?? '';
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
        $result = $request->addUser($firstname, $lastname, $email, $password);
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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <h1>Créer un utilisateur</h1>
    <?php if ($message): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <style>
        .toggle-password {
            cursor: pointer;
        }
    </style>
    <form action="" method="POST">
        <div>
            <label for="firstname">Nom</label>
            <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>"
                required>
        </div>
        <div>
            <label for="lastname">Prénom</label>
            <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>"
                required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <div class="input-group-append">
                <input type="password" id="password" name="password" required>
                <span class="input-group-text toggle-password" onclick="togglePassword('password')">&#128065;</span>
            </div>
        </div>

        <div>
            <label for="confirm_password">Confirmer le mot de passe</label>
            <div class="input-group-append">
                <input type="password" id="confirm_password" name="confirm_password" required>
                <span class="input-group-text toggle-password"
                    onclick="togglePassword('confirm_password')">&#128065;</span>
            </div>
        </div>
        <div>
            <button type="submit">Créer</button>
        </div>
    </form>
    <a href="./home.php">Revenir à la page d'acceuil</a>
    <script>
        function togglePassword(fieldId) {
            var field = document.getElementById(fieldId);
            if (field.type === "password") {
                field.type = "text";
            } else {
                field.type = "password";
            }
        }
    </script>
</body>

</html>