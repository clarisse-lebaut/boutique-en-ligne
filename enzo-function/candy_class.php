<?php
require_once 'db.php';

class candy {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getcandyById($id) {
        $query = "SELECT c.*, m.name AS mark_name FROM candy c JOIN mark m ON c.id_mark = m.id WHERE c.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPaginatedcandy($page, $candys_per_page) {
        $offset = ($page - 1) * $candys_per_page;
        $query = "SELECT * FROM candy LIMIT :offset, :limit";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $candys_per_page, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalcandyCount() {
        $query = "SELECT COUNT(*) AS total FROM candy";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    public function isFavorite($user_id, $candy_id) {
        // Dummy logic for demonstration (you need to implement this based on your favorites table structure)
        return false;
    }

    public function addToFavorites($user_id, $candy_id) {
        // Dummy logic for demonstration (you need to implement this based on your favorites table structure)
    }

    public function removeFromFavorites($user_id, $candy_id) {
        // Dummy logic for demonstration (you need to implement this based on your favorites table structure)
    }
}
?>
