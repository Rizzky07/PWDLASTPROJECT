<?php
require_once(__DIR__ . '/../../model/Product.php');
require_once(__DIR__ . '/../../model/Kategori.php');

$product = new Product();
$kategoriModel = new Kategori();
$kategoriList = $kategoriModel->getAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'name' => $_POST['name'],
        'category' => $_POST['id_kategori'],
        'price' => $_POST['price'],
        'stock' => $_POST['stock'],
        'image' => $_FILES['image']['name'],
        'description' => $_POST['description'] ?? ''
    ];

    move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../../img/' . $_FILES['image']['name']);
    $product->insert($data);

    header("Location: ../../admin/dashboard.php?module=produk&page=daftar-produk");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #333;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 120px;
            resize: vertical;
        }
        .file-input {
            margin-top: 5px;
        }
        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Tambah Produk</h1>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Nama Produk</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="id_kategori">Kategori</label>
            <select id="id_kategori" name="id_kategori" required>
                <option value="">-- Pilih Kategori --</option>
                <?php foreach ($kategoriList as $kategori): ?>
                    <option value="<?= $kategori['id_kategori']; ?>">
                        <?= htmlspecialchars($kategori['nama_kategori']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="price">Harga</label>
            <input type="number" id="price" name="price" required>
        </div>

        <div class="form-group">
            <label for="stock">Stok Produk</label>
            <input type="number" id="stock" name="stock" required>
        </div>

        <div class="form-group">
            <label for="image">Gambar Produk</label>
            <input type="file" id="image" name="image" class="file-input" required>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea id="description" name="description" placeholder="Tambahkan deskripsi untuk produk ini"></textarea>
        </div>

        <button type="submit" class="submit-btn">Simpan Produk</button>
    </form>
</body>
</html>
