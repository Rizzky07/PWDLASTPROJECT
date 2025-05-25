<?php
session_start();
if (!isset($_SESSION['id_pengguna']) || $_SESSION['level'] != 1) {
    header("Location: index.php");
    exit;
}
echo "Selamat datang User!";
?>

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
        <div class="top-nav">
            <div class="logo">Gramedia.com</div>
            <div class="search-bar">
                <select><option>Kategori</option></select>
                <input type="text" placeholder="Cari Produk, Judul Buku, atau Penulis">
            </div>
            <div class="auth-buttons">
            <a href="admin/login.php"><button class="btn-login" >Masuk</button></a>
            <a href="admin/login.php"><button class="btn-register">Daftar</button></a>  
            </div>
        </div>
    </header>

    <div class="promo-banner">
        Promo Hari Ini! Dapatkan diskon tambahan untuk pembelian di atas Rp100.000. <a href="#">Lihat Detail</a>
    </div>

    <main>
    <section class="hero">
  <div class="banner-left">
    <div class="promo-card special-offer">
      <img src="img/Desain tanpa judul.png" alt="Promo 1">
      <div class="promo-label">Special Offer</div>
    </div>
  </div>
  <div class="banner-right">
    <div class="promo-card orange">
      <img src="img/oolc7mp-c4.webp" alt="Promo 2" height="50px">
      <div class="promo-label">Special Offer</div>
    </div>
    <div class="promo-card blue">
      <img src="img/s987ic-n6o.webp" alt="Promo 3" height="50px">
      <div class="promo-label">Pre-Order</div>
    </div>
  </div>
</section>

<!-- <section class="promo-grid">
  <div class="promo-item big">
    <img src="img/piring.webp" alt="Promo Besar">
  </div>
  <div class="promo-item small">
    <img src="img/gelas.webp" alt="Promo 1">
  </div>
  <div class="promo-item small">
    <img src="img/piring.webp" alt="Promo 2">
  </div>
  <div class="promo-item small">
    <img src="img/kotak.webp" alt="Promo 3">
  </div>
  <div class="promo-item small">
    <img src="img/makanankotak.webp" alt="Promo 4">
  </div>
</section> -->

<div class="promo-item big">
    <img src="img/Gambar Ikea.webp" alt="Promo Besar">
  </div>
  
        <section class="kategori">
    <h2>Jelajahi kategori unggulan kami</h2>
    <div class="kategori-list">
        <div class="kategori-item">
            <img src="img/page__en_us_1726029608398_4_0.webp" alt="Kasur dan aksesoris">
            <p><span>Kasur dan aksesoris</span> <span class="arrow">→</span></p>
        </div>
        <div class="kategori-item">
            <img src="img/page__en_us_1726029608586_4_1.webp" alt="Duvet dan bantal">
            <p><span>Duvet dan bantal</span> <span class="arrow">→</span></p>
        </div>
        <div class="kategori-item">
            <img src="img/page__en_us_1726029608786_4_2.webp" alt="Karpet">
            <p><span>Karpet</span> <span class="arrow">→</span></p>
        </div>
        <div class="kategori-item">
            <img src="img/page__en_us_1726029608858_4_3.webp" alt="Lampu kamar tidur">
            <p><span>Lampu kamar tidur</span> <span class="arrow">→</span></p>
        </div>
        <div class="kategori-item">
            <img src="img/page__en_us_1726029608940_4_4.webp" alt="Dekorasi kamar tidur">
            <p><span>Dekorasi kamar tidur</span></p>
        </div>
    </div>
</section>

    </main>

    <footer>
        <div class="footer-columns">
            <div class="footer-col">
                <h4>Information</h4>
                <ul>
                    <li>About Us</li>
                    <li>E-Books FAQ</li>
                    <li>Store Locations</li>
                    <li>Shipping & Delivery</li>
                    <li>Terms & Conditions</li>
                    <li>Privacy Policy</li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Customer Service</h4>
                <ul>
                    <li>Contact Us</li>
                    <li>Returns</li>
                    <li>Site Map</li>
                    <li>How to Register</li>
                    <li>How to Shop</li>
                    <li>How to Ship & Pay</li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>