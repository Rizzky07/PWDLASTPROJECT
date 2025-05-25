<?php
session_start();


require_once 'koneksi.php';

class Auth extends koneksi{

    private $conn;
    public function __construct(){
        parent::__construct();
        $this->conn = $this -> getConnection();
    }

    public function login($email, $password){
        $sql = "SELECT * FROM auth WHERE email = '$email'";
        $query = $this->conn->query($sql);

        if($query->num_rows > 0){
            $row = $query->fetch_assoc();
            if(password_verify($password, $row['password'])){
                // echo "berhasil login";
                $_SESSION['id_pengguna'] = $row['id_pengguna'];
                $_SESSION['level'] = $row['level'];

                // return $row['id_pengguna'];
                // Redirect sesuai level
                return $row['level'];
                if ($row['level'] == 0) {
                    header("Location: index.php");
                    exit();
                } elseif ($row['level'] == 1) {
                    header("Location: index.php");
                    exit();
                }
                return $row['level'];
        }else {
            return false;
            // echo "gagal login";
        }
    }
}}


//  $auth = new Auth();
//  $auth->login('asep@gmail.com', '12345');

?>