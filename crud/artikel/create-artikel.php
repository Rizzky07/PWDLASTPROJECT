<?php
require_once('../model/Artikel.php');
$artikel = new Artikel();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'tanggal' => $_POST['tanggal'],
        'judul' => $_POST['judul'],
        'penulis' => $_POST['penulis'],
        'deskripsi' => $_POST['deskripsi'],
        'posting' => isset($_POST['posting']) ? 1 : 0
    ];
    
    $artikel->create($data);
    header("Location: daftar-artikel.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Artikel</title>
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
  <h2><i class="fas fa-plus"></i> Tambah Artikel</h2>
  
  <form method="post">
    <div class="form-group">
      <label for="tanggal">Tanggal</label>
      <input type="date" id="tanggal" name="tanggal" required>
    </div>
    
    <div class="form-group">
      <label for="judul">Judul</label>
      <input type="text" id="judul" name="judul" required>
    </div>
    
    <div class="form-group">
      <label for="penulis">Penulis</label>
      <input type="text" id="penulis" name="penulis" required>
    </div>
    
    <div class="form-group">
      <label for="deskripsi">Deskripsi</label>
      <textarea id="deskripsi" name="deskripsi" required></textarea>
    </div>
    
    <div class="form-group checkbox-group">
      <input type="checkbox" id="posting" name="posting">
      <label for="posting">Posting Artikel</label>
    </div>
    
    <div class="buttons">
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
      <a href="daftar-artikel.php" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</a>
    </div>
  </form>
</div>

<script>
  // Set tanggal default ke hari ini
  document.getElementById('tanggal').valueAsDate = new Date();
</script>

</body>
</html>