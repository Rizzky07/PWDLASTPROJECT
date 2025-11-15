<?php
require_once('../../model/Toko.php'); // naik 2 level dari crud/toko ke model/
$toko = new Toko();

// Validasi ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID tidak valid.");
}

$id = (int)$_GET['id'];
$toko->delete($id);

// Redirect setelah hapus
header("Location: ../../admin/dashboard.php?module=toko&page=daftar-toko");
exit;
?>
