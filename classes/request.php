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
}
