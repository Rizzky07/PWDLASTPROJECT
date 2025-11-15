<?php
require_once('../../model/Promo.php');
$promo = new Promo();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Proses upload gambar
    $namaFile = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $namaFile = basename($_FILES['image']['name']);
        $targetDir = '../../img/';
        $targetFile = $targetDir . $namaFile;

        // Validasi ekstensi file (opsional)
        $ext = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        if (in_array($ext, $allowed)) {
            move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
        } else {
            $namaFile = null; // Kosongkan jika ekstensi tidak valid
        }
    }

    $data = [
        'nama_promo' => $_POST['nama_promo'],
        'deskripsi' => $_POST['deskripsi'],
        'jenis' => $_POST['jenis'],
        'nilai' => $_POST['nilai'],
        'tanggal_mulai' => $_POST['tanggal_mulai'],
        'tanggal_berakhir' => $_POST['tanggal_berakhir'],
        'status' => isset($_POST['status']) ? 'aktif' : 'nonaktif',
        'image' => $namaFile
    ];

    $promo->insert($data);
    header("Location: ../../admin/dashboard.php?module=promo&page=daftar-promo");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Promo</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 20px;
      background-color: #f5f5f5;
    }

    .form-wrapper {
      background: white;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      max-width: 800px;
      margin: 0 auto;
    }

    h2 {
      color: #333;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="date"],
    input[type="number"],
    input[type="file"],
    textarea,
    select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      box-sizing: border-box;
    }

    textarea {
      height: 120px;
      resize: vertical;
    }

    .checkbox-group {
      display: flex;
      align-items: center;
    }

    .checkbox-group input {
      width: auto;
      margin-right: 10px;
    }

    .buttons {
      margin-top: 20px;
    }

    .btn {
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
    }

    .btn-primary {
      background-color: #4CAF50;
      color: white;
    }

    .btn-primary:hover {
      background-color: #45a049;
    }

    .btn-secondary {
      background-color: #6c757d;
      color: white;
    }

    .btn-secondary:hover {
      background-color: #5a6268;
    }
  </style>
</head>
<body>

<div class="form-wrapper">
  <h2><i class="fas fa-plus"></i> Tambah Promo</h2>

  <form method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="nama_promo">Nama Promo</label>
      <input type="text" id="nama_promo" name="nama_promo" required>
    </div>

    <div class="form-group">
      <label for="deskripsi">Deskripsi</label>
      <textarea id="deskripsi" name="deskripsi" required></textarea>
    </div>

    <div class="form-group">
      <label for="jenis">Jenis Promo</label>
      <select id="jenis" name="jenis" required>
        <option value="">-- Pilih Jenis --</option>
        <option value="diskon">Diskon (%)</option>
        <option value="potongan_langsung">Potongan Langsung (Rp)</option>
        <option value="voucher">Voucher (Rp)</option>
      </select>
    </div>

    <div class="form-group">
      <label for="nilai">Nilai Promo</label>
      <input type="number" id="nilai" name="nilai" min="0" required>
    </div>

    <div class="form-group">
      <label for="tanggal_mulai">Tanggal Mulai</label>
      <input type="date" id="tanggal_mulai" name="tanggal_mulai" required>
    </div>

    <div class="form-group">
      <label for="tanggal_berakhir">Tanggal Berakhir</label>
      <input type="date" id="tanggal_berakhir" name="tanggal_berakhir" required>
    </div>

    <div class="form-group">
      <label for="image">Gambar Promo</label>
      <input type="file" id="image" name="image" accept="image/*">
    </div>

    <div class="form-group checkbox-group">
      <input type="checkbox" id="status" name="status">
      <label for="status">Aktifkan Promo</label>
    </div>

    <div class="buttons">
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
      <a href="daftar-promo.php" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</a>
    </div>
  </form>
</div>

</body>
</html>
