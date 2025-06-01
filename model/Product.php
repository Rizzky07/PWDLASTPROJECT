<?php
require_once('koneksi.php');

class Product extends koneksi {
    private $conn;

    public function __construct(){
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function getAll(){
        $query = "SELECT * FROM products ORDER BY id DESC";
        $result = $this->conn->query($query);

        $data = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
        }
        return $data;
    }

    public function getByCategory($category) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE category = ?");
        $stmt->bind_param("s", $category);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
    public function insert($data) {
        $stmt = $this->conn->prepare("INSERT INTO products (name, category, price, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $data['name'], $data['category'], $data['price'], $data['image']);
        return $stmt->execute();
    }
    
    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE products SET name=?, category=?, price=?, image=? WHERE id=?");
        $stmt->bind_param("ssisi", $data['name'], $data['category'], $data['price'], $data['image'], $id);
        return $stmt->execute();
    }
    
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    

   


}
?>
