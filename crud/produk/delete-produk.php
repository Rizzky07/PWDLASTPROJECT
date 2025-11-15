<?php
require_once('../../model/Product.php'); // naik 2 level dari crud/produk ke model/
$product = new Product();
$id = $_GET['id'];
$product->delete($id);
header("Location: ../../admin/dashboard.php?module=produk&page=daftar-produk");
exit;
?>
