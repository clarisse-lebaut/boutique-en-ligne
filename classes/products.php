<?php
// require '../config/session.php';
class Request extends BDD
{
    function __construct()
    {
        parent::__construct();
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
}