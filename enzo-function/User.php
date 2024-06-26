<?php
require_once 'Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getFavorites($user_id) {
        $sql = "SELECT products.* FROM favorites JOIN products ON favorites.product_id = products.id WHERE favorites.user_id = ?";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
}
?>
