<?php
require_once('../../model/Artikel.php');
$artikel = new Artikel();

// Validasi ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID artikel tidak valid.");
}

$id = (int)$_GET['id'];

// Ambil data artikel berdasarkan ID
$data = $artikel->getById($id);

// Cek apakah data artikel ditemukan
if (!$data) {
    die("Artikel tidak ditemukan.");
}

// Proses update saat form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $updateData = [
        'tanggal' => $_POST['tanggal'],
        'judul' => $_POST['judul'],
        'penulis' => $_POST['penulis'],
        'deskripsi' => $_POST['deskripsi'],
        'posting' => isset($_POST['posting']) ? 1 : 0
    ];

    // Jalankan update
    $artikel->update($id, $updateData);

    // Redirect setelah berhasil update
    header("Location: ../../admin/dashboard.php?module=artikel&page=daftar-artikel");
    exit;
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Artikel</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 20px;
      background-color: #f5f5f5;
    }
    
    h2 {
      color: #333;
      margin-bottom: 20px;
    }
    
    .form-wrapper {
      background: white;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      max-width: 800px;
      margin: 0 auto;
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
    textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      box-sizing: border-box;
    }
    
    textarea {
      height: 150px;
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
  <h2><i class="fas fa-edit"></i> Edit Artikel</h2>
  
  <form method="post">
    <div class="form-group">
      <label for="tanggal">Tanggal</label>
      <input type="date" id="tanggal" name="tanggal" value="<?= $data['tanggal']; ?>" required>
    </div>
    
    <div class="form-group">
      <label for="judul">Judul</label>
      <input type="text" id="judul" name="judul" value="<?= htmlspecialchars($data['judul']); ?>" required>
    </div>
    
    <div class="form-group">
      <label for="penulis">Penulis</label>
      <input type="text" id="penulis" name="penulis" value="<?= htmlspecialchars($data['penulis']); ?>" required>
    </div>
    
    <div class="form-group">
      <label for="deskripsi">Deskripsi</label>
      <textarea id="deskripsi" name="deskripsi" required><?= htmlspecialchars($data['deskripsi']); ?></textarea>
    </div>
    
    <div class="form-group checkbox-group">
      <input type="checkbox" id="posting" name="posting" <?= $data['posting'] ? 'checked' : ''; ?>>
      <label for="posting">Posting Artikel</label>
    </div>
    
    <div class="buttons">
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
      <a href="daftar-artikel.php" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</a>
    </div>
  </form>
</div>

</body>
</html>