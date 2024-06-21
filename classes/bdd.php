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
      throw new Error($e->getMessage());
    }
  }
}
