<?php
header('Content-Type: application/json');
$response = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $level = $_POST['level'] ?? '1';

    // Validasi
    if (empty($nama) || empty($email) || empty($password)) {
        $response = ['success' => false, 'message' => 'Semua field wajib diisi.'];
    } else {
        require_once '../model/Koneksi.php';
        $conn = $koneksi->getConnection(); // ambil koneksi dari class

        $email = $conn->real_escape_string($email);
        $nama = $conn->real_escape_string($nama);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $cek = $conn->query("SELECT * FROM auth WHERE email='$email'");
        if ($cek->num_rows > 0) {
            $response = ['success' => false, 'message' => 'Email sudah terdaftar.'];
        } else {
            $query = $conn->query("INSERT INTO auth (nama, email, password, level) 
                                   VALUES ('$nama', '$email', '$passwordHash', '$level')");
            if ($query) {
                $response = ['success' => true, 'message' => 'Registrasi berhasil.'];
            } else {
                $response = ['success' => false, 'message' => 'Gagal menyimpan data.'];
            }
        }
    }
} else {
    $response = ['success' => false, 'message' => 'Metode tidak diizinkan.'];
}

echo json_encode($response);
