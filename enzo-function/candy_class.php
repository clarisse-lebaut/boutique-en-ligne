<?php
require_once __DIR__ . '/../classes/bdd.php';
class Candy {
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

    public function getPaginatedCandy($page, $candys_per_page, $category = null, $min_price = null, $max_price = null, $sort_by = 'name', $order = 'asc') {
        $offset = ($page - 1) * $candys_per_page;
        $query = "SELECT * FROM candy WHERE 1=1";

        if ($category) {
            $query .= " AND category = :category";
        }
        if ($min_price) {
            $query .= " AND price >= :min_price";
        }
        if ($max_price) {
            $query .= " AND price <= :max_price";
        }

        $query .= " ORDER BY $sort_by $order LIMIT :offset, :limit";
        $stmt = $this->conn->prepare($query);

        if ($category) {
            $stmt->bindValue(':category', $category, PDO::PARAM_STR);
        }
        if ($min_price) {
            $stmt->bindValue(':min_price', $min_price, PDO::PARAM_INT);
        }
        if ($max_price) {
            $stmt->bindValue(':max_price', $max_price, PDO::PARAM_INT);
        }
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $candys_per_page, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalCandyCount($category = null, $min_price = null, $max_price = null) {
        $query = "SELECT COUNT(*) AS total FROM candy WHERE 1=1";

        if ($category) {
            $query .= " AND category = :category";
        }
        if ($min_price) {
            $query .= " AND price >= :min_price";
        }
        if ($max_price) {
            $query .= " AND price <= :max_price";
        }

        $stmt = $this->conn->prepare($query);

        if ($category) {
            $stmt->bindValue(':category', $category, PDO::PARAM_STR);
        }
        if ($min_price) {
            $stmt->bindValue(':min_price', $min_price, PDO::PARAM_INT);
        }
        if ($max_price) {
            $stmt->bindValue(':max_price', $max_price, PDO::PARAM_INT);
        }

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    public function getCandiesByIds($ids) {
        if (empty($ids)) {
            return [];
        }

        $query = "SELECT * FROM candy WHERE id IN (" . implode(',', array_map('intval', $ids)) . ")";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
