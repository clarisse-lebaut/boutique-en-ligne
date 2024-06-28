<?php
class BDD
{
  protected PDO $connection;

  function __construct()
  {
    try {
      $this->connection = new PDO("mysql:host=localhost;dbname=candyshop", "root", "");
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo '<p class="text-danger">Impossible to connect the database!</p>' . "\n";
      throw new Error($e->getMessage());
    }
  }

  // Add this new method
  public function getConnection(): PDO
  {
    return $this->connection;
  }
}
