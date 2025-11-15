<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Produk Komik</title>
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
  </style>
</head>
<body>

  <h2>Produk Komik</h2>

  <?php
  require_once(__DIR__ . '/../../model/Product.php');
  $produk = new Product();

  // Ambil data produk dengan kategori 'Komik'
  $dataKomik = $produk->getByCategory(3);
  ?>

  <div class="card-grid">
    <?php foreach($dataKomik as $row): ?>
      <div class="card">
        <div class="card-image-container">
          <img class="card-image" src="../img/<?= htmlspecialchars($row['image']); ?>" alt="<?= htmlspecialchars($row['name']); ?>">
        </div>

        <div class="card-content">
          <h3 class="card-title"><?= htmlspecialchars($row['name']); ?></h3>
          <p class="card-description"><?= htmlspecialchars($row['category']); ?></p>
          <div class="card-tags">
            <span class="tag">Rp <?= number_format($row['price'], 0, ',', '.'); ?></span>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

</body>
</html>
