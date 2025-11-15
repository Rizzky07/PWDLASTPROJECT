<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Produk Buku Fiksi</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 20px;
      background-color: #f5f5f5;
    }

    .card-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }

    .card {
      width: 200px;
      border: 1px solid #eee;
      border-radius: 12px;
      overflow: hidden;
      background-color: white;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
      transition: 0.3s;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }

    .card-image-container {
      height: 180px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #f9f9f9;
    }

    .card-image {
      max-height: 160px;
      max-width: 100%;
      object-fit: contain;
    }

    .card-content {
      padding: 12px;
      display: flex;
      flex-direction: column;
    }

    .card-description {
      font-size: 12px;
      color: #888;
      margin-bottom: 6px;
    }

    .card-title {
      font-size: 14px;
      font-weight: 600;
      margin: 4px 0;
      color: #333;
      min-height: 40px;
    }

    .card-tags .tag {
      background-color: #e0f0ff;
      color: #007BFF;
      padding: 4px 8px;
      font-size: 13px;
      font-weight: bold;
      border-radius: 6px;
      display: inline-block;
    }

    .btn-add-cart {
      margin-top: 10px;
      display: block;
      width: 100%;
      background-color: #28a745;
      border: none;
      color: white;
      font-weight: 600;
      padding: 8px 0;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      text-align: center;
      font-size: 14px;
    }

    .btn-add-cart:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>

<h2>Produk Buku Fiksi</h2>

<?php
require_once(__DIR__ . '/../../model/Product.php');
$produk = new Product();

// Ambil data produk kategori 'Fiksi'
$dataFiksi = $produk->getByCategory(1);
?>

<div class="card-grid">
  <?php foreach($dataFiksi as $row): ?>
    <div class="card">
      <div class="card-image-container">
        <img class="card-image" src="/../../img/<?= htmlspecialchars($row['image']); ?>" alt="<?= htmlspecialchars($row['name']); ?>" />
      </div>

      <div class="card-content">
        <h3 class="card-title"><?= htmlspecialchars($row['name']); ?></h3>
        <p class="card-description"><?= htmlspecialchars($row['nama_kategori'] ?? ''); ?></p>
        <div class="card-tags">
          <span class="tag">Rp <?= number_format($row['price'], 0, ',', '.'); ?></span>
        </div>

        <!-- Form Tambah ke Keranjang via AJAX -->
        <form class="form-add-cart" method="post">
          <input type="hidden" name="product_id" value="<?= htmlspecialchars($row['id']); ?>">
          <input type="hidden" name="qty" value="1">
          <button type="submit" class="btn-add-cart">+ Keranjang</button>
        </form>

      </div>
    </div>
  <?php endforeach; ?>
</div>

<script>
  document.querySelectorAll('.form-add-cart').forEach(form => {
    form.addEventListener('submit', function (e) {
      e.preventDefault();

      const formData = new FormData(form);

      fetch('/pages/produk/keranjang.php', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (!response.ok) throw new Error("Gagal menambahkan ke keranjang");
        return response.text();
      })
      .then(data => {
        alert('Produk berhasil ditambahkan ke keranjang!');
        // TODO: bisa update jumlah keranjang di navbar jika mau
      })
      .catch(error => {
        alert('Terjadi kesalahan: ' + error.message);
      });
    });
  });
</script>

</body>
</html>
