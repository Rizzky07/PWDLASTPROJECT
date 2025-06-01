<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Product</title>
  <link rel="stylesheet" href="../../../asset/daftar-produk.css">
</head>
<body>

<h1>Product Details</h1>

<div class="table-wrapper">
  <div class="add-button">
    <a href="../../../crud/produk/create-produk.php"><i class="fas fa-plus"></i> Tambah Product</a>
  </div>

  <table>
    <thead>
      <tr>
        <th>COVER</th>
        <th>NAME</th>
        <th>CATEGORY</th>
        <th>PRICE</th>
        <th>ACTION</th>
      </tr>
    </thead>
    <tbody>
    <?php 
      require_once(__DIR__ . '/../../../model/Product.php');
      $produk = new Product();
      $produk = $produk->getAll();
      foreach($produk as $row){
    ?>
      <tr>
        <td><img src="../../../img/<?= htmlspecialchars($row['image']); ?>" alt="<?= htmlspecialchars($row['name']); ?>"></td>
        <td><strong><?= htmlspecialchars($row['name']); ?></strong></td>
        <td><?= htmlspecialchars($row['category']); ?></td>
        <td>Rp <?= number_format($row['price'], 0, ',', '.'); ?></td>
        <td class="text-center">
          <a href="../../../crud/produk/update-produk.php?id=<?= $row['id']; ?>"><strong>Edit</strong></a>
          <a href="../../../crud/produk/delete-produk.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?');"><strong>Hapus</strong></a>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>
