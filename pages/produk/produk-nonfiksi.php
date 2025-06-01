<?php
require_once(__DIR__ . '/../../model/Product.php');
$produk = new Product();

// Ambil data produk dengan kategori 'Non Fiksi'
$dataNonFiksi = $produk->getByCategory('Non Fiksi');
?>

<div class="card-grid">
  <?php foreach($dataNonFiksi as $row): ?>
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
