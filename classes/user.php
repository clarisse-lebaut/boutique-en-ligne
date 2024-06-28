<?php
// require '../config/session.php';

class Request extends BDD
{
  function __construct()
  {
    parent::__construct();
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
}