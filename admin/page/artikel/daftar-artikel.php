<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Artikel</title>
  <link rel="stylesheet" href="../asset/daftar-artikel.css">
</head>
<body>

<h2><i class="fas fa-newspaper"></i> Daftar Artikel</h2>

<div class="table-wrapper">
  <div class="add-button">
    <a href="#"><i class="fas fa-plus"></i> Tambah Artikel</a>
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
      <?php 
        require_once('../model/Artikel.php');
        $artikel = new Artikel();
        $artikels = $artikel->getAll();
        $nomor = 1;
        foreach($artikels as $row){
      ?>
        <tr>
          <td><?= $nomor++; ?></td>
          <td><?= $row['tanggal']; ?></td>
          <td><?= $row['judul']; ?></td>
          <td><?= $row['penulis']; ?></td>
          <td><?= $row['deskripsi']; ?></td>
          <td><?= $row['posting']; ?></td>
          <td class="text-center">
            <a href="#"><i class="fas fa-eye text-succes" title="Detail"></i></a>
            <a href="#"><i class="fas fa-edit text-warning" title="Edit"></i></a>
            <a href="#"><i class="fas fa-trash text-danger" title="Hapus"></i></a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>
