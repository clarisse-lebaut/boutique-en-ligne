<?php
require_once __DIR__ . '/bdd.php';

class Request extends BDD {
    private $conn;
    private const TABLE_ACCOUNT = 'account';
    private const TABLE_CANDY = 'candy';

    public function __construct() {
        parent::__construct();
        $this->conn = $this->connection;
    }

    // Get account by email
    public function getAccount($email) {
        $query = "SELECT * FROM " . self::TABLE_ACCOUNT . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get account by ID
    public function getAccountById($id) {
        $query = "SELECT * FROM " . self::TABLE_ACCOUNT . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Check if an account exists by email
    public function isAccountExist($email) {
        $query = "SELECT COUNT(*) FROM " . self::TABLE_ACCOUNT . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Validate password
    public function isPasswordValid($email, $password) {
        $account = $this->getAccount($email);
        if ($account) {
            return password_verify($password, $account['password']);
        }
        return false;
    }

    // Update account
    public function updateAccount($id, $firstname, $lastname, $address, $zipcode, $email, $password) {
        $query = "UPDATE " . self::TABLE_ACCOUNT . " SET firstname = :firstname, lastname = :lastname, address = :address, zipcode = :zipcode, email = :email, password = :password, updated_at = CURRENT_TIMESTAMP WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':zipcode', $zipcode, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Register a new account
    public function registerAccount($firstname, $lastname, $address, $zipcode, $email, $password) {
        if ($this->isAccountExist($email)) {
            return 'Email already exists';
        }

        $query = "INSERT INTO " . self::TABLE_ACCOUNT . " (firstname, lastname, address, zipcode, email, password) VALUES (:firstname, :lastname, :address, :zipcode, :email, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':zipcode', $zipcode, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $this->startSession($this->conn->lastInsertId(), $firstname);
            header('Location: ../pages/home.php');
            exit();
        } else {
            return 'Failed to add user';
        }
    }

    // Delete account by ID
    public function deleteAccount($id) {
        $query = "DELETE FROM " . self::TABLE_ACCOUNT . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Get all accounts
    public function getAccounts() {
        $query = "SELECT * FROM " . self::TABLE_ACCOUNT;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new user
    public function addUser($firstname, $lastname, $email, $address, $postal_code, $password) {
        if ($this->isAccountExist($email)) {
            return 'Email already exists';
        }

        $role = 'User';
        $query = "INSERT INTO " . self::TABLE_ACCOUNT . " (firstname, lastname, email, address, postal_code, password, role) VALUES (:firstname, :lastname, :email, :address, :postal_code, :password, :role)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':postal_code', $postal_code, PDO::PARAM_STR);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $this->startSession($this->conn->lastInsertId(), $firstname);
            header('Location: ../pages/home.php');
            exit();
        } else {
            return 'Failed to add user';
        }
    }

    // Get products for carousel
    public function getProductsCarousel() {
        $query = "SELECT name, price FROM " . self::TABLE_CANDY . " ORDER BY created_at DESC LIMIT 5";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get products for checkerboard
    public function getProductsCheckerBoard() {
        $query = "SELECT name, price FROM " . self::TABLE_CANDY . " ORDER BY RAND() LIMIT 9";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Helper function to start a session
    private function startSession($user_id, $firstname) {
        session_start();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['firstname'] = $firstname;
    }

    // Helper function to end a session
    public function endSession() {
        session_start();
        session_unset();
        session_destroy();
    }
}
?>
