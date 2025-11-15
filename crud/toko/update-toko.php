<?php
require_once('../../model/Toko.php');
$toko = new Toko();

// Validasi ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID tidak valid.");
}

$id = (int)$_GET['id'];
$data = $toko->getById($id);

if (!$data) {
    die("Data toko tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gambarLama = $data['gambar'];
    $gambarBaru = $gambarLama;

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $fileTmp = $_FILES['gambar']['tmp_name'];
        $fileName = basename($_FILES['gambar']['name']);
        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($ext, $allowedExt)) {
            $namaBaru = 'toko_' . time() . '.' . $ext;
            $uploadDir = '../../img/';
            $uploadPath = $uploadDir . $namaBaru;

            if (move_uploaded_file($fileTmp, $uploadPath)) {
                // Hapus gambar lama jika ada
                if (!empty($gambarLama) && file_exists($uploadDir . $gambarLama)) {
                    unlink($uploadDir . $gambarLama);
                }
                $gambarBaru = $namaBaru;
            } else {
                echo "<script>alert('Gagal mengupload gambar.');</script>";
            }
        } else {
            echo "<script>alert('Format gambar tidak didukung. Gunakan JPG, PNG, atau GIF.');</script>";
        }
    }

    $updateData = [
        'nama_toko' => $_POST['nama_toko'],
        'deskripsi' => $_POST['deskripsi'],
        'alamat' => $_POST['alamat'],
        'kontak' => $_POST['kontak'],
        'jam_buka' => $_POST['jam_buka'],
        'gambar' => $gambarBaru
    ];

    $toko->update($id, $updateData);
    header("Location: ../../admin/dashboard.php?module=toko&page=daftar-toko");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Toko</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f5f5;
      padding: 20px;
    }

    .form-wrapper {
      background: white;
      padding: 20px;
      border-radius: 5px;
      max-width: 800px;
      margin: 0 auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      color: #333;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    input[type="text"],
    textarea,
    input[type="file"] {
      width: 100%;
      padding: 10px;
      box-sizing: border-box;
      border-radius: 4px;
      border: 1px solid #ccc;
    }

    textarea {
      height: 100px;
    }

    .btn {
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
      margin-right: 10px;
    }

    .btn-primary {
      background-color: #007bff;
      color: white;
    }

    .btn-secondary {
      background-color: #6c757d;
      color: white;
    }

    .btn:hover {
      opacity: 0.9;
    }

    .preview-img {
      margin-bottom: 10px;
      max-width: 200px;
    }
  </style>
</head>
<body>

<div class="form-wrapper">
  <h2><i class="fas fa-edit"></i> Edit Data Toko</h2>

  <form method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="nama_toko">Nama Toko</label>
      <input type="text" name="nama_toko" id="nama_toko" value="<?= htmlspecialchars($data['nama_toko']); ?>" required>
    </div>

    <div class="form-group">
      <label for="deskripsi">Deskripsi</label>
      <textarea name="deskripsi" id="deskripsi" required><?= htmlspecialchars($data['deskripsi']); ?></textarea>
    </div>

    <div class="form-group">
      <label for="alamat">Alamat</label>
      <textarea name="alamat" id="alamat" required><?= htmlspecialchars($data['alamat']); ?></textarea>
    </div>

    <div class="form-group">
      <label for="kontak">Kontak</label>
      <input type="text" name="kontak" id="kontak" value="<?= htmlspecialchars($data['kontak']); ?>" required>
    </div>

    <div class="form-group">
      <label for="jam_buka">Jam Buka</label>
      <input type="text" name="jam_buka" id="jam_buka" value="<?= htmlspecialchars($data['jam_buka']); ?>" required>
    </div>

    <div class="form-group">
      <label for="gambar">Gambar</label>
      <?php if (!empty($data['gambar'])): ?>
        <img src="../../uploads/<?= htmlspecialchars($data['gambar']); ?>" alt="Gambar Toko" class="preview-img"><br>
      <?php endif; ?>
      <input type="file" name="gambar" id="gambar">
    </div>

    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
    <a href="daftar-toko.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
  </form>
</div>

</body>
</html>
