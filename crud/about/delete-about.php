<?php
require_once('../../model/About.php'); // naik 2 level dari crud/about ke model/
$about = new About();

// Pastikan ID ada dan valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $about->delete($id);
}

// Redirect kembali ke halaman daftar about
header("Location: ../../admin/dashboard.php?module=about&page=daftar-about");
exit;
?>
