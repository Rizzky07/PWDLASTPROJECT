<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar About</title>
  <style>
    body {
      font-family: "Segoe UI", sans-serif;
      background-color: #f9f9f9;
      color: #333;
      margin: 0px;
      padding: 0px;
    }

    h1 {
      color: #222;
      font-size: 28px;
      margin-bottom: 20px;
      border-bottom: 3px solid #007bff;
      padding-bottom: 8px;
    }

    .table-wrapper {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
    }

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
  </style>
</head>
<body>

<h1>Daftar About</h1>

<div class="table-wrapper">
  <div class="add-button">
    <a href="../../../crud/about/create-about.php">Tambah About</a>
  </div>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Isi</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    <?php 
      require_once(__DIR__ . '/../../../model/About.php');
      $about = new About();
      $dataAbout = $about->getAll();
      $no = 1;
      foreach($dataAbout as $row):
    ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= htmlspecialchars($row['judul']); ?></td>
        <td><?= nl2br(htmlspecialchars($row['isi'])); ?></td>
        <td class="text-center">
          <a href="../../../crud/about/update-about.php?id=<?= $row['id_about']; ?>"><strong>Edit</strong></a>
          <a href="../../../crud/about/delete-about.php?id=<?= $row['id_about']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?');"><strong>Hapus</strong></a>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>

</body>
</html>
