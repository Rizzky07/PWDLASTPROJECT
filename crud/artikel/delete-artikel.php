<?php
require_once('../../model/Artikel.php'); // naik 2 level dari crud/artikel ke model/
$artikel = new Artikel();

// Validasi ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID tidak valid.");
}

$id = (int)$_GET['id'];
$artikel->delete($id);

// Redirect setelah hapus
header("Location: ../../admin/dashboard.php?module=artikel&page=daftar-artikel");
exit;
?>

