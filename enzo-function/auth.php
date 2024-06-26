<?php
session_start();
require_once 'Database.php';

// Fonction pour gérer le logout
function logout() {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Fonction pour gérer le login
function login($email, $password) {
    $db = new Database();
    $sql = "SELECT id, password FROM account WHERE email = ?";
    $stmt = $db->conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['message'] = "Login successful.";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['error'] = "Invalid credentials.";
    }
}

// Fonction pour gérer l'enregistrement
function register($firstname, $lastname, $email, $password) {
    $db = new Database();
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $role = 'user';

    $sql = "INSERT INTO account (firstname, lastname, email, password, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->conn->prepare($sql);
    $stmt->bind_param("sssss", $firstname, $lastname, $email, $hashed_password, $role);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Registration successful. Please log in.";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
    }
}

// Gestion des actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'login':
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';
                if (!empty($email) && !empty($password)) {
                    login($email, $password);
                } else {
                    $_SESSION['error'] = "Both email and password are required.";
                }
                break;
            case 'register':
                $firstname = $_POST['firstname'] ?? '';
                $lastname = $_POST['lastname'] ?? '';
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';
                if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($password)) {
                    register($firstname, $lastname, $email, $password);
                } else {
                    $_SESSION['error'] = "All fields are required.";
                }
                break;
            case 'logout':
                logout();
                break;
        }
    }
}

// Affichage du formulaire approprié
$action = $_GET['action'] ?? 'login';
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo ucfirst($action); ?></title>
</head>
<body>
    <h2><?php echo ucfirst($action); ?></h2>
    <?php
    if (isset($_SESSION['message'])) {
        echo "<p style='color:green'>" . $_SESSION['message'] . "</p>";
        unset($_SESSION['message']);
    }
    if (isset($_SESSION['error'])) {
        echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    ?>

    <?php if ($action == 'login'): ?>
        <form method="post">
            <input type="hidden" name="action" value="login">
            Email: <input type="email" name="email" required><br>
            Password: <input type="password" name="password" required><br>
            <input type="submit" value="Login">
        </form>
        <p>Don't have an account? <a href="?action=register">Register</a></p>
    <?php elseif ($action == 'register'): ?>
        <form method="post">
            <input type="hidden" name="action" value="register">
            Firstname: <input type="text" name="firstname" required><br>
            Lastname: <input type="text" name="lastname" required><br>
            Email: <input type="email" name="email" required><br>
            Password: <input type="password" name="password" required><br>
            <input type="submit" value="Register">
        </form>
        <p>Already have an account? <a href="?action=login">Login</a></p>
    <?php endif; ?>
</body>
</html>