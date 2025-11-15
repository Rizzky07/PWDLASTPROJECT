<?php
require_once('koneksi.php');

class Product extends koneksi {
    private $conn;

    public function __construct() {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    // Ambil semua data produk + nama kategori
    public function getAll() {
        $query = "SELECT products.*, kategori.nama_kategori 
                  FROM products 
                  LEFT JOIN kategori ON products.id_kategori = kategori.id_kategori 
                  ORDER BY products.id DESC";

        $result = $this->conn->query($query);

        if (!$result) {
            die("Query error: " . $this->conn->error);
        }

        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function count() {
        $sql = "SELECT COUNT(*) as total FROM products";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    // Ambil produk berdasarkan kategori ID
    public function getByCategory($id_kategori) {
        $stmt = $this->conn->prepare("SELECT products.*, kategori.nama_kategori 
                                      FROM products 
                                      LEFT JOIN kategori ON products.id_kategori = kategori.id_kategori 
                                      WHERE products.id_kategori = ?");
        $stmt->bind_param("i", $id_kategori);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Ambil produk berdasarkan ID (untuk edit form)
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Insert produk baru (dengan deskripsi)
    public function insert($data) {
        $stmt = $this->conn->prepare("INSERT INTO products (name, description, id_kategori, price, image, stock) 
                                      VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ssiisi",
            $data['name'],
            $data['description'],
            $data['id_kategori'],
            $data['price'],
            $data['image'],
            $data['stock']
        );
        return $stmt->execute();
    }

    // Update produk (dengan deskripsi)
    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE products SET name=?, description=?, id_kategori=?, price=?, image=?, stock=? WHERE id=?");
        $stmt->bind_param(
            "ssiisii",
            $data['name'],
            $data['description'],
            $data['id_kategori'],
            $data['price'],
            $data['image'],
            $data['stock'],
            $id
        );
        return $stmt->execute();
    }

    // Hapus produk
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Ambil semua kategori (untuk select box)
    public function getAllCategories() {
        $query = "SELECT * FROM kategori ORDER BY nama_kategori ASC";
        $result = $this->conn->query($query);
        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    // Ambil nama kategori berdasarkan ID
    public function getCategoryName($id_kategori) {
        $stmt = $this->conn->prepare("SELECT nama_kategori FROM kategori WHERE id_kategori = ?");
        $stmt->bind_param("i", $id_kategori);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result ? $result['nama_kategori'] : null;
    }
}
?>
