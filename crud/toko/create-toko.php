<?php
require_once('../../model/Toko.php');
$toko = new Toko();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gambar = '';

    // Cek jika file gambar diunggah dan tidak error
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $fileTmp = $_FILES['gambar']['tmp_name'];
        $fileName = basename($_FILES['gambar']['name']);
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];

        // Validasi ekstensi
        if (in_array($fileExt, $allowedExt)) {
            $namaBaru = 'toko_' . time() . '.' . $fileExt;
            $uploadDir = '../../img/';
            $uploadPath = $uploadDir . $namaBaru;

            // Pindahkan file ke folder uploads
            if (move_uploaded_file($fileTmp, $uploadPath)) {
                $gambar = $namaBaru;
            } else {
                echo "<script>alert('Gagal mengupload gambar.');</script>";
            }
        } else {
            echo "<script>alert('Format gambar tidak didukung. Gunakan JPG, PNG, atau GIF.');</script>";
        }
    }

    $data = [
        'nama_toko' => $_POST['nama_toko'],
        'deskripsi' => $_POST['deskripsi'],
        'alamat' => $_POST['alamat'],
        'kontak' => $_POST['kontak'],
        'jam_buka' => $_POST['jam_buka'],
        'gambar' => $gambar
    ];

    $toko->insert($data);
    header("Location: ../../admin/dashboard.php?module=toko&page=daftar-toko");
    exit;
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Toko</title>
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
    textarea,
    input[type="file"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      box-sizing: border-box;
    }

    textarea {
      height: 100px;
      resize: vertical;
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
  <h2><i class="fas fa-store"></i> Tambah Toko</h2>

  <form method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="nama_toko">Nama Toko</label>
      <input type="text" id="nama_toko" name="nama_toko" required>
    </div>

    <div class="form-group">
      <label for="deskripsi">Deskripsi</label>
      <textarea id="deskripsi" name="deskripsi" required></textarea>
    </div>

    <div class="form-group">
      <label for="alamat">Alamat</label>
      <textarea id="alamat" name="alamat" required></textarea>
    </div>

    <div class="form-group">
      <label for="kontak">Kontak</label>
      <input type="text" id="kontak" name="kontak" required>
    </div>

    <div class="form-group">
      <label for="jam_buka">Jam Buka</label>
      <input type="text" id="jam_buka" name="jam_buka" placeholder="Contoh: Senin - Jumat, 08.00 - 17.00" required>
    </div>

    <div class="form-group">
      <label for="gambar">Upload Gambar</label>
      <input type="file" id="gambar" name="gambar" accept="image/*">
    </div>

    <div class="buttons">
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
      <a href="daftar-toko.php" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</a>
    </div>
  </form>
</div>

</body>
</html>
