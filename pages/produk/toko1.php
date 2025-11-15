<?php
require_once(__DIR__ . '/../../model/Toko.php');
$toko = new Toko();
$dataToko = $toko->getAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Toko Kami</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fff;
      margin: 0;
      padding: 40px 45px;
    }

    .breadcrumb {
      font-size: 14px;
      color: #555;
      margin-bottom: 16px;
    }

    .breadcrumb a {
      color: #000;
      text-decoration: underline;
      margin-right: 4px;
    }

    .hero-banner {
      width: 100%;
      max-height: 250px;
      overflow: hidden;
      border-radius: 12px;
      margin-bottom: 30px;
    }

    .hero-banner img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    h2 {
      font-size: 28px;
      margin-bottom: 20px;
      color: #000;
      font-weight: bold;
    }

    .search-box {
      display: flex;
      align-items: center;
      max-width: 400px;
      margin-bottom: 30px;
      position: relative;
    }

    .search-box input {
      width: 100%;
      padding: 14px 45px 14px 20px;
      border: 1px solid #ccc;
      border-radius: 30px;
      font-size: 15px;
      background-color: #fff;
    }

    .search-box i {
      position: absolute;
      right: 16px;
      font-size: 16px;
      color: #aaa;
    }

    .toko-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(500px, 1fr));
      gap: 20px;
    }

    .toko-card {
      display: flex;
      align-items: center;
      background-color: #fff;
      padding: 24px;
      border-radius: 16px;
      border: 1px solid #eee;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
      gap: 20px;
    }

    .toko-card img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 12px;
      background-color: #f0f0f0;
    }

    .toko-info {
      flex: 1;
    }

    .toko-info h3 {
      margin: 0;
      font-size: 18px;
      font-weight: bold;
      color: #000;
    }

    .toko-info p {
      margin: 5px 0;
      font-size: 14px;
      color: #333;
    }

    .map-icon {
      font-size: 18px;
      color: #000;
    }

    @media screen and (max-width: 600px) {
      .toko-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>

  <div class="breadcrumb">
    <a href="#">Home</a> &gt; Toko Kami
  </div>

  <div class="hero-banner">
    <img src="img/our-store-banner.4fbacd2a.jpg" alt="Banner Toko Kami" loading="lazy" />
  </div>

  <h2>Toko Kami</h2>

  <div class="search-box">
    <input type="text" placeholder="Cari Toko atau Lokasi">
    <i class="fas fa-search"></i>
  </div>

  <?php if (empty($dataToko)): ?>
    <p>Tidak ada toko tersedia saat ini.</p>
  <?php else: ?>
    <div class="toko-grid">
      <?php foreach ($dataToko as $row): ?>
        <?php
          $gambar = htmlspecialchars($row['gambar'] ?? 'default-toko.jpg');
          $nama = htmlspecialchars($row['nama_toko'] ?? '(Tanpa Nama)');
          $alamat = htmlspecialchars($row['alamat'] ?? 'Alamat tidak tersedia');
          $jam = htmlspecialchars($row['jam_buka'] ?? '-');
        ?>
        <div class="toko-card">
          <img src="../../img/<?= $gambar; ?>" alt="<?= $nama; ?>">
          <div class="toko-info">
            <h3><?= $nama; ?></h3>
            <p><?= $alamat; ?></p>
            <p><?= $jam; ?></p>
          </div>
          <i class="fas fa-map-marker-alt map-icon"></i>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

</body>
</html>
