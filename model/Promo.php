<?php
require_once('koneksi.php');

class Promo extends koneksi {
    private $conn;

    public function __construct() {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    // Ambil semua promo
    public function getAll() {
        $sql = "SELECT * FROM promo ORDER BY tanggal_mulai DESC";
        $result = $this->conn->query($sql);
        $data = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    // Tambah data promo (dengan kolom image)
    public function insert($data) {
        $sql = "INSERT INTO promo (nama_promo, deskripsi, jenis, nilai, tanggal_mulai, tanggal_berakhir, status, image)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "sssissss",
            $data['nama_promo'],
            $data['deskripsi'],
            $data['jenis'],
            $data['nilai'],
            $data['tanggal_mulai'],
            $data['tanggal_berakhir'],
            $data['status'],
            $data['image']
        );
        return $stmt->execute();
    }

    // Ambil promo berdasarkan ID
    public function getById($id) {
        $sql = "SELECT * FROM promo WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Update data promo (dengan kolom image)
    public function update($id, $data) {
        $sql = "UPDATE promo SET nama_promo = ?, deskripsi = ?, jenis = ?, nilai = ?, tanggal_mulai = ?, tanggal_berakhir = ?, status = ?, image = ?
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "sssissssi",
            $data['nama_promo'],
            $data['deskripsi'],
            $data['jenis'],
            $data['nilai'],
            $data['tanggal_mulai'],
            $data['tanggal_berakhir'],
            $data['status'],
            $data['image'],
            $id
        );
        return $stmt->execute();
    }

    // Hapus promo
    public function delete($id) {
        $sql = "DELETE FROM promo WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
