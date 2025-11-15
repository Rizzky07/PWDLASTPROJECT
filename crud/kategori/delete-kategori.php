<?php
require_once('../../model/Kategori.php'); // naik 2 level dari crud/kategori ke model/
$kategori = new Kategori();
$id = $_GET['id'];

$kategori->delete($id);

header("Location: ../../admin/dashboard.php?module=kategori&page=daftar-kategori");
exit;
?>
