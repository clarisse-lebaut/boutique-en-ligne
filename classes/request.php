<?php
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

  public function addUser($firstname, $lastname, $email, $address, $zipcode, $password)
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
    $sql = 'INSERT INTO account (firstname, lastname, email, address, zipcode, password, role) VALUES (:firstname, :lastname, :email, :address, :zipcode, :password, :role)';
    $stmt = $this->connection->prepare($sql);

    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':zipcode', $zipcode);
    // Hachage du mot de passe avant de le stocker
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':role', $role);

    if ($stmt->execute()) {
      // Rediriger vers la page d'accueil
      // echo "Utilsateur ajouté à la base de donnée";
      header('Location: index.php?page=' . PAGE_CONNECTION);
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
    $sql = 'SELECT * FROM candy ORDER BY RAND() LIMIT 9';
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
    $query = "SELECT candy.*, mark.name as mark_name FROM candy INNER JOIN mark ON candy.id_mark = mark.id;";
    $result = $this->connection->query($query);
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getCommentary($id)
  {
    $query = "SELECT comment.content, comment.updated_at, comment.created_at, account.firstname as creator_firstname, account.lastname as creator_lastname FROM comment inner join candy on comment.id_candy = candy.id inner join account on comment.id_account = account.id WHERE id_candy = :id;";
    $stmt = $this->connection->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute([":id" => $id]);
    return $stmt->fetchAll();
  }

  public function getCandyById(int $id)
  {
    $query = "SELECT * FROM candy WHERE id = :id";
    $stmt = $this->connection->prepare($query);
    $stmt->execute([":id" => $id]);
    return $stmt->fetch();
  }

  public function getCategories()
  {
    $query = "SELECT * FROM category";
    $result = $this->connection->query($query);
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getCandiesByCategory(int $id = null)
  {
    if ($id == null) {
      return $this->getAllCandies();
    } else {
      if ($id >= 1) {
        $query = "SELECT candy.* FROM classification INNER JOIN candy ON classification.id_candy = candy.id WHERE classification.id_category = :id;";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([":id" => $id]);
        return $stmt->fetchAll();
      } else {
        throw new Exception("The id have to be greater or equal to 1!");
      }
    }
  }

  public function getClassificationCandy()
  {
    $query = "SELECT * FROM classification";
    $result = $this->connection->query($query);
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getCandyDetailsByName($name)
  {
    $query = "SELECT * FROM candy WHERE name = :name LIMIT 1";
    $stmt = $this->connection->prepare($query);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

}

