<?php
require_once(__DIR__ . '/../../../model/Artikel.php');
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
  <style>
    /* General Reset & Base */
    body {
      font-family: "Segoe UI", sans-serif;
      background-color: #f9f9f9;
      color: #333;
      margin: 0px;
      padding: 0px;
    }

    h2 {
      color: #222;
      font-size: 28px;
      margin-bottom: 20px;
      border-bottom: 3px solid #007bff;
      padding-bottom: 8px;
    }

    /* Table Wrapper */
    .table-wrapper {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
    }

    /* Add Button */
    .add-button {
      text-align: right;
      margin-bottom: 20px;
    }

    .add-button a {
      display: inline-block;
      padding: 10px 20px;
      background-color: #28a745;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }

    .add-button a:hover {
      background-color: #218838;
    }

    /* Table Styles */
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 14px 16px;
      text-align: left;
      border-bottom: 1px solid #ddd;
      vertical-align: top;
    }

    th {
      background-color: #f1f1f1;
      color: #333;
      font-weight: 600;
    }

    tbody tr:hover {
      background-color: #f9f9f9;
    }

    /* Action Buttons */
    .text-center a {
      display: inline-block;
      padding: 6px 10px;
      text-decoration: none;
      border-radius: 4px;
      font-weight: bold;
      margin: 2px;
      font-size: 13px;
    }

    .text-center a:first-child {
      text-decoration: none;
      background-color: #007bff;
      color: white;
    }

    .text-center a:last-child {
      background-color: #dc3545;
      color: white;
    }

    .text-center a:hover {
      opacity: 0.9;
    }

    i {
    font-style: normal;
  }
  </style>
</head>
<body>

<h2><i class="fas fa-newspaper"></i> Daftar Artikel</h2>

<div class="table-wrapper">
  <div class="add-button">
    <a href="../../../crud/artikel/create-artikel.php"><i class="fas fa-plus"></i> Tambah Artikel</a>
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
            <a href="../../../crud/artikel/update-artikel.php?id=<?= $row['id']; ?>"><i class="fas fa-edit text-warning" title="Edit"> Edit</i></a>
            <a href="../../../crud/artikel/delete-artikel.php?id=<?= $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
    <i class="fas fa-trash text-danger" title="Hapus">Hapus</i>
</a>
          </td>
        </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>

</body>
</html>