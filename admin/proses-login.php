<?php
require_once '../model/auth.php';

header('Content-Type: application/json');

$auth = new Auth();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
    exit;
}

try {
    // ambil data
    $email    = $_POST['email']    ?? '';
    $password = $_POST['password'] ?? '';

    // panggil model
    $login = $auth->login($email, $password);

    if ($login !== false ) {
        // kredensial valid
        echo json_encode([
            'success' => true,
            'level' => $login
        ]);
    } else {
        // kredensial salah
        echo json_encode([
            'success' => false,
            'message' => 'Email atau password salah.'
        ]);
    }

} catch (Exception $e) {
    // kalau ada error di server (misal DB down)
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Server error: ' . $e->getMessage()
    ]);
}
