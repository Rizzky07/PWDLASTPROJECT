<?php
require_once('koneksi.php');

class Dashboard extends Koneksi {
    private $conn;

    public function __construct() {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function getArticleCount() {
        $query = "SELECT COUNT(*) as count FROM artikel";
        $result = $this->conn->query($query);
        $row = $result->fetch_assoc();
        return $row['count'];
    }

    public function getProductCount() {
        $query = "SELECT COUNT(*) as count FROM products";
        $result = $this->conn->query($query);
        $row = $result->fetch_assoc();
        return $row['count'];
    }

    public function getServiceCount() {
        $query = "SELECT COUNT(*) as count FROM services";
        $result = $this->conn->query($query);
        $row = $result->fetch_assoc();
        return $row['count'];
    }
}
?>