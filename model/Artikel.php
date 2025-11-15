<?php
require_once('koneksi.php');

class Artikel extends koneksi {
    private $conn;

    public function __construct() {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    // Ambil semua artikel
    public function getAll() {
        $query = "SELECT * FROM artikel ORDER BY id DESC";
        $result = $this->conn->query($query);

        $data = array();
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function count() {
        $sql = "SELECT COUNT(*) as total FROM artikel";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    // Ambil artikel berdasarkan ID
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM artikel WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Tambah artikel baru
    public function insert($data) {
        $stmt = $this->conn->prepare("INSERT INTO artikel (tanggal, judul, penulis, deskripsi, posting) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", 
            $data['tanggal'], 
            $data['judul'], 
            $data['penulis'], 
            $data['deskripsi'], 
            $data['posting']
        );
        return $stmt->execute();
    }

    // Update artikel berdasarkan ID
    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE artikel SET tanggal=?, judul=?, penulis=?, deskripsi=?, posting=? WHERE id=?");
        $stmt->bind_param("ssssii", 
            $data['tanggal'], 
            $data['judul'], 
            $data['penulis'], 
            $data['deskripsi'], 
            $data['posting'], 
            $id
        );
        return $stmt->execute();
    }

    // Hapus artikel berdasarkan ID
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM artikel WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
