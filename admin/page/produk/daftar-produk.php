<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Product</title>
  <link rel="stylesheet" href="../asset/daftar-artikel.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<h2><i class="fas fa-newspaper"></i> Daftar Produk</h2>

<div class="table-wrapper">
  <div class="add-button">
  <a href="create.php"><i class="fas fa-plus"></i> Tambah Produk</a>

  </div>

  <table>
    <thead>
      <tr>
        <th>NO</th>
        <th>NAME</th>
        <th>IMAGE</th>
        <th>CATEGORY</th>
        <th>PRICE</th>
        <th>AKSI</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        require_once('../model/Product.php');
        $produk = new Product();
        $dataProduk = $produk->getAll();
        $nomor = 1;
        foreach($dataProduk as $row){
      ?>
        <tr>
          <td><?= $nomor++; ?></td>
          <td><?= $row['name']; ?></td>
          <td><img src="../img/<?= $row['image']; ?>" alt="<?= $row['name']; ?>" width="80"></td>
          <td><?= $row['category']; ?></td>
          <td>Rp <?= number_format($row['price'], 0, ',', '.'); ?></td>
          <td class="text-center">
            <a href="create.php?id=<?= $row['id']; ?>" class="text-warning" title="Edit"><i class="fas fa-edit"></i> Edit</a>
            <a href="#" class="text-danger" title="Hapus"><i class="fas fa-trash"></i> Hapus</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>
