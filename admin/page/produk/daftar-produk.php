<!-- <!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk</title>
  <style>


    h1 {
      text-align: center;
      color: #333;
    }

    .katalog-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      padding: 20px;
    }

    .katalog-item {
      background-color: whites;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 16px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      text-align: center;
      transition: transform 0.2s ease;
    }

    .katalog-item:hover {
      transform: scale(1.03);
    }

    .katalog-item h3 {
      margin-top: 0;
      color: #007BFF;
    }

    .katalog-item p {
      font-size: 14px;
      color: #555;
    }

    .welcome {
    text-align: center;
    font-size: 23px;
    margin: 10px 0 20px;
  color: #333333;
    font-family: 'Montserrat', sans-serif;
    position: relative;
    z-index: 1;

    position: center;   
    padding-bottom: 10px; 
    display: inline-block; 
    }

  </style>
</head>
<body>
      
    <h2 class="welcome">Daftar Produk</h1>
    

  <div class="katalog-container">
    <div class="katalog-item">
      <h3>Produk 1</h3>
      <p>Deskripsi singkat produk 1</p>
    </div>
    <div class="katalog-item">
      <h3>Produk 2</h3>
      <p>Deskripsi singkat produk 2</p>
    </div>
    <div class="katalog-item">
      <h3>Produk 3</h3>
      <p>Deskripsi singkat produk 3</p>
    </div>
    <div class="katalog-item">
      <h3>Produk 4</h3>
      <p>Deskripsi singkat produk 4</p>
    </div>
    <div class="katalog-item">
      <h3>Produk 5</h3>
      <p>Deskripsi singkat produk 5</p>
    </div>
    <div class="katalog-item">
      <h3>Produk 6</h3>
      <p>Deskripsi singkat produk 6</p>
    </div>
       <div class="katalog-item">
      <h3>Produk 7</h3>
      <p>Deskripsi singkat produk 7</p>
    </div>
       <div class="katalog-item">
      <h3>Produk 9</h3>
      <p>Deskripsi singkat produk 9</p>
    </div>
       <div class="katalog-item">
      <h3>Produk 10</h3>
      <p>Deskripsi singkat produk 10</p>
    </div>
       <div class="katalog-item">
      <h3>Produk 11</h3>
      <p>Deskripsi singkat produk 11</p>
    </div>
       <div class="katalog-item">
      <h3>Produk 12</h3>
      <p>Deskripsi singkat produk 12</p>
    </div>
    </div>
  </div>
</body>
</html>
 -->

 <!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Product</title>
  <link rel="stylesheet" href="../asset/daftar-artikel.css">
</head>
<body>

<h2><i class="fas fa-newspaper"></i> Daftar Product</h2>

<div class="table-wrapper">
  <div class="add-button">
    <a href="#"><i class="fas fa-plus"></i> Tambah Product</a>
  </div>

  <table>
    <thead>
      <tr>
        <th>NO</th>
        <th>NAME</th>
        <th>IMAGE</th>
        <th>CATEGORY</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        require_once('../model/Product.php');
        $artikel = new product();
        $artikels = $artikel->getAll();
        $nomor = 1;
        foreach($artikels as $row){
      ?>
        <tr>
          <td><?= $nomor++; ?></td>
          <td><?= $row['name']; ?></td>
          <td><?= $row['image']; ?></td>
          <td><?= $row['category']; ?></td>
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