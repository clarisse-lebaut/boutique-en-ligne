<?php
// require '../config/session.php';

class Request extends BDD
{
  function __construct()
  {
    parent::__construct();
  }

  function getAccounts(): array
  {
    try {
      $sql = "SELECT * FROM account;";
      $stmt = $this->connection->prepare($sql);
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $stmt->execute();
      return $stmt->fetchAll();
    } catch (PDOException $e) {
      echo '<p style="color:red">Impossible to get all account!</p>' . "\n";
      throw new Exception($e->getMessage());
    }
  }

  function getAccountById(int $id): array
  {
    try {
      $sql = "select * from account where id = :id;";
      $stmt = $this->connection->prepare($sql);
      $stmt->execute([":id" => $id]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo '<p style="color:red">Impossible to get the account!</p>' . "\n";
      throw new Exception($e->getMessage());
    }
  }

  function getAccount(string $email): array
  {
    try {
      $sql = "select * from account where email = :email;";
      $stmt = $this->connection->prepare($sql);
      $stmt->execute([":email" => $email]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo '<p style="color:red">Impossible to get the account!</p>' . "\n";
      throw new Exception($e->getMessage());
    }
  }

  function updateAccount(int $id, string $firstname, string $lastname, string $address, string $zipcode, string $email, string $password): void
  {
    try {
      $sql = "UPDATE account SET firstname = :firstname, lastname = :lastname, address = :address, zipcode = :zipcode, email = :email, password = :password, updated_at = CURRENT_TIMESTAMP WHERE id = :id;";
      $stmt = $this->connection->prepare($sql);
      $stmt->execute([
        ":id" => $id,
        ":firstname" => $firstname,
        ":lastname" => $lastname,
        ":address" => $address,
        ":zipcode" => $zipcode,
        ":email" => $email,
        ":password" => $password
      ]);
    } catch (PDOException $e) {
      echo '<p style="color:red">Impossible to update the account!</p>' . "\n";
      throw new Exception($e->getMessage());
    }
  }

  function isAccountExist(string $email): bool
  {
    try {
      $sql = "SELECT * FROM account WHERE email = :email;";

      $stmt = $this->connection->prepare($sql);
      $stmt->execute([":email" => $email]);

      return $stmt->rowCount() > 0 ? true : false;
    } catch (PDOException $e) {
      echo '<p style="color:red">Impossible to check if an account exist or not!</p>' . "\n";
      throw new Exception($e->getMessage());
    }
  }

  function isPasswordValid(string $email, string $password): bool
  {
    try {
      $sql = "SELECT * FROM account WHERE email = :email;";

      $stmt = $this->connection->prepare($sql);
      $stmt->execute([":email" => $email]);

      $output = $stmt->fetch(PDO::FETCH_ASSOC);
      return password_verify($password, $output["password"]);
    } catch (PDOException $e) {
      echo '<p style="color:red">Impossible to check if the password is valid or not!</p>' . "\n";
      throw new Exception($e->getMessage());
    }
  }

  public function addUser($firstname, $lastname, $email, $adress, $postal_code, $password)
  {
    // Vérifier si l'adresse e-mail existe déjà
    $checkSql = 'SELECT COUNT(*) FROM account WHERE email = :email';
    $checkStmt = $this->connection->prepare($checkSql);
    $checkStmt->bindParam(':email', $email);
    $checkStmt->execute();
    $emailExists = $checkStmt->fetchColumn();

    if ($emailExists) {
      return 'Email already exists';
    }

    // Si l'email n'existe pas, ajouter le nouvel utilisateur
    $role = 'User'; // Valeur par défaut pour le rôle
    $sql = 'INSERT INTO account (firstname, lastname, email, adress, postal_code, password, role) VALUES (:firstname, :lastname, :email, :adress, :postal_code, :password, :role)';
    $stmt = $this->connection->prepare($sql);

    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':adress', $adress);
    $stmt->bindParam(':postal_code', $postal_code);
    // Hachage du mot de passe avant de le stocker
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':role', $role);

    if ($stmt->execute()) {
      // Démarrer une session pour l'utilisateur
      session_start();
      $_SESSION['user_id'] = $this->connection->lastInsertId(); // ID du nouvel utilisateur
      $_SESSION['firstname'] = $firstname;

      // Rediriger vers la page d'accueil
      header('Location: ../pages/home.php');
      exit(); // Assurez-vous de quitter le script après la redirection
    } else {
      return 'Failed to add user';
    }
  }

  public function getProductsCarousel()
  {
    $sql = 'SELECT name, price FROM candy ORDER BY created_at DESC LIMIT 5';
    $stmt = $this->connection->prepare($sql);

    if ($stmt->execute()) {
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      return $stmt->fetchAll();
    } else {
      return false;
    }
  }

  public function getProductsCheckerBoard()
  {
    $sql = 'SELECT name, price FROM candy ORDER BY RAND() LIMIT 9';
    $stmt = $this->connection->prepare($sql);

    if ($stmt->execute()) {
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      return $stmt->fetchAll();
    } else {
      return false;
    }
  }

  public function getAllCandies()
  {
    $query = "SELECT * FROM candy";
    $result = $this->connection->query($query);
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getCandyById(int $id)
  {
    $query = "SELECT * FROM candy WHERE id = :id";
    $stmt = $this->connection->prepare($query);
    $stmt->execute([":id" => $id]);

    return $stmt->fetch();
  }

  public function isFavorite($user_id, $candy_id)
  {
    // Dummy logic for demonstration (you need to implement this based on your favorites table structure)
    return false;
  }

  public function addToFavorites($user_id, $candy_id)
  {
    // Dummy logic for demonstration (you need to implement this based on your favorites table structure)
  }

  public function removeFromFavorites($user_id, $candy_id)
  {
    // Dummy logic for demonstration (you need to implement this based on your favorites table structure)
  }
}

