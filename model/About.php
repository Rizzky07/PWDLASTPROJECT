<?php 
require_once('koneksi.php');

class About extends koneksi {
    private $conn;

    public function __construct() {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    // Ambil semua data About
    public function getAll() {
        $query = "SELECT * FROM about ORDER BY id DESC";
        $result = $this->conn->query($query);

        $data = array();
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    // Ambil data berdasarkan ID
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM about WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Tambah data About baru
    public function insert($data) {
        $stmt = $this->conn->prepare("INSERT INTO about (judul, isi) VALUES (?, ?)");
        $stmt->bind_param("ss", 
            $data['judul'], 
            $data['isi']
        );
        return $stmt->execute();
    }

    // Update data About berdasarkan ID
    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE about SET judul=?, isi=? WHERE id=?");
        $stmt->bind_param("ssi", 
            $data['judul'], 
            $data['isi'], 
            $id
        );
        return $stmt->execute();
    }

    // Hapus data berdasarkan ID
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM about WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // (Opsional) Hitung total about
    public function count() {
        $sql = "SELECT COUNT(*) as total FROM about";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'];
    }
}
?>
