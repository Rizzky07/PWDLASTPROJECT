<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Produk Teknologi dan Komputer</title>
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
      position: relative;
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
    }

    .store-badge {
      position: absolute;
      bottom: 0;
      left: 0;
      background-color: #6C63FF;
      color: white;
      font-size: 11px;
      font-weight: 500;
      padding: 4px 8px;
      border-top-right-radius: 8px;
    }

    .wishlist-icon {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 18px;
      color: #ccc;
      cursor: pointer;
    }

    .wishlist-icon:hover {
      color: red;
    }
  </style>
</head>
<body>

  <h2>Produk Teknologi & Komputer</h2>

  <?php
  require_once(__DIR__ . '/../../model/Product.php');
  $produk = new Product();

  // Ambil data produk dengan kategori 'Teknologi dan Komputer'
  $dataTeknologi = $produk->getByCategory('Teknologi dan Komputer');
  ?>

  <div class="card-grid">
    <?php foreach($dataTeknologi as $row): ?>
      <div class="card">
        <div class="wishlist-icon">♡</div>
        <div class="card-image-container">
          <img class="card-image" src="../img/<?= htmlspecialchars($row['image']); ?>" alt="<?= htmlspecialchars($row['name']); ?>">
        </div>

        <div class="card-content">
          <p class="card-description"><?= htmlspecialchars($row['category']); ?></p>
          <h3 class="card-title"><?= htmlspecialchars($row['name']); ?></h3>
          <div class="card-tags">
            <span class="tag">Rp <?= number_format($row['price'], 0, ',', '.'); ?></span>
          </div>
        </div>

        <div class="store-badge">Gramedia Official</div>
      </div>
    <?php endforeach; ?>
  </div>

</body>
</html>
