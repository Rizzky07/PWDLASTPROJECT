<?php
require_once(__DIR__ . '/koneksi.php'); // ini BENAR, karena koneksi.php berada di folder yg sama

class Toko extends koneksi {
    private $conn;

    public function __construct() {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function getAll() {
        $sql = "SELECT * FROM toko ORDER BY id DESC";
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
        $sql = "INSERT INTO toko (nama_toko, deskripsi, alamat, kontak, jam_buka, gambar)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "ssssss",
            $data['nama_toko'],
            $data['deskripsi'],
            $data['alamat'],
            $data['kontak'],
            $data['jam_buka'],
            $data['gambar']
        );
        return $stmt->execute();
    }

    public function getById($id) {
        $sql = "SELECT * FROM toko WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update($id, $data) {
        $sql = "UPDATE toko SET nama_toko = ?, deskripsi = ?, alamat = ?, kontak = ?, jam_buka = ?, gambar = ?
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "ssssssi",
            $data['nama_toko'],
            $data['deskripsi'],
            $data['alamat'],
            $data['kontak'],
            $data['jam_buka'],
            $data['gambar'],
            $id
        );
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM toko WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
