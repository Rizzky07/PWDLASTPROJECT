<?php
require_once('../model/Artikel.php');
$artikel = new Artikel();

// Handle delete
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $artikel->delete($_GET['id']);
    header("Location: daftar-artikel.php");
    exit;
}

$artikels = $artikel->getAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Artikel</title>
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
    
    .table-wrapper {
      background: white;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    
    .add-button {
      margin-bottom: 20px;
    }
    
    .add-button a {
      display: inline-block;
      background: #4CAF50;
      color: white;
      padding: 10px 15px;
      text-decoration: none;
      border-radius: 4px;
      transition: background 0.3s;
    }
    
    .add-button a:hover {
      background: #45a049;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
    }
    
    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    
    th {
      background-color: #f2f2f2;
      font-weight: bold;
    }
    
    tr:hover {
      background-color: #f9f9f9;
    }
    
    .text-center {
      text-align: center;
    }
    
    .text-warning {
      color: #ffc107;
    }
    
    .text-danger {
      color: #dc3545;
    }
    
    a {
      text-decoration: none;
      margin: 0 5px;
    }
    
    i {
      margin-right: 5px;
    }
  </style>
</head>
<body>

<h2><i class="fas fa-newspaper"></i> Daftar Artikel</h2>

<div class="table-wrapper">
  <div class="add-button">
    <a href="tambah-artikel.php"><i class="fas fa-plus"></i> Tambah Artikel</a>
  </div>

  <table>
    <thead>
      <tr>
        <th>NO</th>
        <th>TANGGAL</th>
        <th>JUDUL</th>
        <th>PENULIS</th>
        <th>DESKRIPSI</th>
        <th>POSTING</th>
        <th>AKSI</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($artikels)): ?>
        <tr>
          <td colspan="7" class="text-center">Tidak ada artikel</td>
        </tr>
      <?php else: ?>
        <?php $nomor = 1; ?>
        <?php foreach($artikels as $row): ?>
        <tr>
          <td><?= $nomor++; ?></td>
          <td><?= date('d M Y', strtotime($row['tanggal'])); ?></td>
          <td><?= htmlspecialchars($row['judul']); ?></td>
          <td><?= htmlspecialchars($row['penulis']); ?></td>
          <td><?= substr(htmlspecialchars($row['deskripsi']), 0, 50) . '...'; ?></td>
          <td><?= $row['posting'] == 1 ? 'Ya' : 'Tidak'; ?></td>
          <td class="text-center">
            <a href="edit-artikel.php?id=<?= $row['id']; ?>"><i class="fas fa-edit text-warning" title="Edit"> Edit</i></a>
            <a href="daftar-artikel.php?action=delete&id=<?= $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')"><i class="fas fa-trash text-danger" title="Hapus">Hapus</i></a>
          </td>
        </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>

</body>
</html>