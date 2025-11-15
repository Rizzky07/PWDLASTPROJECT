<?php
require_once('koneksi.php');

class Pesanan extends koneksi {
    private $conn;

    public function __construct() {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    // Ambil semua pesanan dengan ringkasan
    public function getAllWithSummary() {
        $query = "
            SELECT 
                p.id_pesanan AS id,
                p.nomor_pesanan,
                p.tanggal,
                a.nama AS nama_pemesan,
                p.total,
                p.status,
                COALESCE(SUM(dp.jumlah), 0) AS jumlah_item
            FROM tpesanan p
            LEFT JOIN auth a ON p.id_pelanggan = a.id_pengguna
            LEFT JOIN tdetail_pesanan dp ON p.id_pesanan = dp.id_pesanan
            GROUP BY p.id_pesanan
            ORDER BY p.tanggal DESC
        ";
        
        $result = $this->conn->query($query);
        $data = [];
    
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
    
        return $data;
    }

    // Ambil detail pesanan berdasarkan ID
    public function getDetailById($id) {
        $query = "
            SELECT 
                p.id_pesanan, p.nomor_pesanan, p.tanggal, p.status, p.total,
                pl.nama, pl.alamat, pl.no_hp
            FROM tpesanan p
            LEFT JOIN tpelanggan pl ON p.id_pelanggan = pl.id_pelanggan
            WHERE p.id_pesanan = ?
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result ? $result->fetch_assoc() : null;
    }

    // Ambil daftar item dalam pesanan
    public function getItemsByPesananId($id) {
        $query = "
            SELECT 
                pr.nama AS produk,
                dp.jumlah,
                dp.harga,
                (dp.jumlah * dp.harga) AS subtotal
            FROM tdetail_pesanan dp
            LEFT JOIN tproduk pr ON pr.id_produk = dp.id_produk
            WHERE dp.id_pesanan = ?
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $items = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }

        return $items;
    }
}
