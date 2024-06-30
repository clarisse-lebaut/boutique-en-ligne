<?php
$message = '';
$firstname = '';
$lastname = '';
$email = '';
$address = '';
$zipcode = '';

if ($_POST) {
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $email = $_POST['email'] ?? '';
    $zipcode = $_POST['zipcode'] ?? '';
    $address = $_POST['address'] ?? '';
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
        $message = 'Les mots de passe ne sont pas identiques';
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
        $result = $request->addUser($firstname, $lastname, $email, $address, $zipcode, $password);
        $message = $result;
    }
}
?>
<div class="mb-5">
    <h2 class="h2">Créez-vous un compte !</h2>
    <hr>
</div>

<div class="navigate m-auto mb-5">
    <a class="a" href="./index?page=<?= PAGE_CONNECTION ?>">Déjà un compte ? Se connecter</a>
</div>

<?php if ($message): ?>
    <p><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>

<div class="container box_form w-50">
    <form class="container_form" action="" method="POST">

        <div class="header_section">
            <p>VOS INFORMATIONS</p>
            <hr>
        </div>

        <div class="data-user">
            <div class="box">
                <label for="firstname">Nom</label>
                <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>"
                    required>
            </div>
            <div class="box">
                <label for="lastname">Prénom</label>
                <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>"
                    required>
            </div>
            <div class="box">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="box">
                <label for="address">Adresse</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>"
                    required>
            </div>
            <div class="box">
                <label for="zipcode">Code Postal</label>
                <input type="number" id="zipcode" name="zipcode" value="<?php echo htmlspecialchars($zipcode); ?>"
                    required>
            </div>
        </div>

        <div class="header_section">
            <p>MOT DE PASSE</p>
            <hr>
        </div>

        <div class="psw-user">
            <div class="box">
                <label for="password">Mot de passe</label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" required>
                    <span id="toggle-password" class="input-group-text toggle-password"
                        onclick="togglePassword('password', 'toggle-password')">Voir</span>
                </div>
                <label for="confirm_password">Confirmer le mot de passe</label>
                <div class="input-wrapper">
                    <input type="password" id="confirm_password" name="confirm_password" required>
                    <span id="toggle-confirm-password" class="input-group-text toggle-password"
                        onclick="togglePassword('confirm_password', 'toggle-confirm-password')">Voir</span>
                </div>
            </div>
        </div>

        <button class="btn btn-primary m-auto mt-5 mb-5" type="submit">Créer</button>

    </form>
</div>
<div class="navigate m-auto text-center mt-5 gap-3">
    <a class="a" href="./index?page=<?= PAGE_CONNECTION ?>">Déjà un compte ? Se connecter</a>
    <a class="a" href="./index?page=<?= PAGE_HOME ?>">Revenir à la page d'accueil</a>
</div>
<script src="./assets/script/toggle.js"></script>