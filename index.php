<!-- <?php
// session_start();
// if (!isset($_SESSION['id_pengguna']) || $_SESSION['level'] != 1) {
//     header("Location: admin/login.php");
//     exit;
// }
// echo "Selamat datang User!";
?> -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gramedia Clone</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
  <div class="header-top-links">
  <ul>
    <li><a href="#">Promo</a></li>
    <li><a href="#">Toko Kami</a></li>
    <li><a href="#">Hubungi Kami</a></li>
  </ul>
</div>
<div class="top-nav">
  <div class="logo">Gramedia.com</div>

  <div class="search-bar">
    <select><option>Kategori</option></select>
    
    <div class="input-wrapper">
      <img src="img/search-interface-symbol.png" alt="search">
      <input type="text" placeholder="Cari Produk, Judul Buku, atau Penulis">
      
    </div>
    
    <!-- Moved cart inside search-bar and right after input-wrapper -->
    <a href="login.php" class="cart-link">
      <img src="img/shopping-cart.png" alt="keranjang">
    </a>
  </div>

  <div class="auth-buttons">
    <a href="admin/login.php"><button class="btn-login">Masuk</button></a>
    <a href="admin/login.php"><button class="btn-register">Daftar</button></a>
  </div>
</div>
</header>

<div class="container-fluid">
<?php
$page = 'pages/Menu-Utama.php'; // default
if (isset($_GET['module']) && isset($_GET['pages'])) {
  $page = 'pages/' . $_GET['module'] . '/' . $_GET['pages'] . '.php';
}
require($page);
?>
      </div>
    </div>
  </div>
</body>
</html>