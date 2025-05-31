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

    public function addProduct($data){
        $name = $this->conn->real_escape_string($data['name']);
        $category = $this->conn->real_escape_string($data['category']);
        $price = $this->conn->real_escape_string($data['price']);
        $description = $this->conn->real_escape_string($data['description']);
        $image = $this->conn->real_escape_string($data['image']);

        $sql = "INSERT INTO products (name, category, price, description, image) VALUES ('$name', '$category', '$price', '$description', '$image')";
        return $this->conn->query($sql);
    }
}
?>
