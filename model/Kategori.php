<?php
require_once('koneksi.php');

class Kategori extends koneksi {
    private $conn;

    public function __construct() {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function getAll() {
        $sql = "SELECT * FROM kategori ORDER BY nama_kategori ASC";
        $result = $this->conn->query($sql);
        $data = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function insert($data) {
        $sql = "INSERT INTO kategori (nama_kategori) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $data['nama_kategori']);
        return $stmt->execute();
    }
    
    public function getById($id) {
        $sql = "SELECT * FROM kategori WHERE id_kategori = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    public function update($id, $data) {
        $sql = "UPDATE kategori SET nama_kategori = ? WHERE id_kategori = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $data['nama_kategori'], $id);
        return $stmt->execute();
    }
    
}
