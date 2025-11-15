<?php
require_once(__DIR__ . '/../../model/Pesanan.php');
$pesanan = new Pesanan();

// Validasi ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
  echo "ID pesanan tidak valid."; exit;
}

// Ambil data detail dan item
$detail = $pesanan->getDetailById($id);
$items = $pesanan->getItemsByPesananId($id);

// Jika tidak ditemukan
if (!$detail) {
  echo "Pesanan tidak ditemukan."; exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Pesanan</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    th { background-color: #f2f2f2; }
    .total { font-weight: bold; text-align: right; padding-top: 10px; }
    .back-link { margin-top: 20px; display: inline-block; }
  </style>
</head>
<body>

  <h2>Detail Pesanan</h2>

  <p><strong>Nomor:</strong> <?= htmlspecialchars($detail['nomor_pesanan']); ?></p>
  <p><strong>Tanggal:</strong> <?= date('d M Y', strtotime($detail['tanggal'])); ?></p>
  <p><strong>Pelanggan:</strong> <?= htmlspecialchars($detail['nama']); ?></p>
  <p><strong>Alamat:</strong> <?= htmlspecialchars($detail['alamat']); ?></p>
  <p><strong>Status:</strong> <?= htmlspecialchars($detail['status']); ?></p>

  <h3>Item Pesanan:</h3>
  <table>
    <thead>
      <tr>
        <th>Produk</th>
        <th>Jumlah</th>
        <th>Harga Satuan</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($items as $item): ?>
      <tr>
        <td><?= htmlspecialchars($item['produk']); ?></td>
        <td><?= $item['jumlah']; ?></td>
        <td>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
        <td>Rp <?= number_format($item['subtotal'], 0, ',', '.'); ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <p class="total">Total Bayar: Rp <?= number_format($detail['total'], 0, ',', '.'); ?></p>

  <a href="javascript:history.back()" class="back-link">← Kembali ke Daftar Pesanan</a>

</body>
</html>
