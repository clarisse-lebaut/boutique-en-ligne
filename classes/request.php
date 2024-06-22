<?php
class Request extends BDD
{
  function __construct()
  {
    parent::__construct();
  }

  function addUser($firstname, $lastname, $email, $password)
  {
    $role = 'User'; // Valeur par défaut pour le rôle
    $sql = 'INSERT INTO account (firstname, lastname, email, password, role) VALUES (:firstname, :lastname, :email, :password, :role)';
    $stmt = $this->connection->prepare($sql);

    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    // Hachage du mot de passe avant de le stocker
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':role', $role);

    if ($stmt->execute()) {
      return 'User added successfully';
    } else {
      return 'Failed to add user';
    }
  }
}

