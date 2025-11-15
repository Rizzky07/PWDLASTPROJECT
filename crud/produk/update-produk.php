<?php
require_once('../../model/Product.php');
require_once('../../model/Kategori.php');

$product = new Product();
$kategoriModel = new Kategori();

$id = $_GET['id'];
$data = $product->getById($id);
$kategoriList = $kategoriModel->getAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $updateData = [
        'name' => $_POST['name'],
        'id_kategori' => $_POST['category'], // ✅ Sesuai dengan field di database
        'price' => $_POST['price'],
        'stock' => $_POST['stock'],
        'image' => !empty($_FILES['image']['name']) ? $_FILES['image']['name'] : $data['image'],
        'description' => $_POST['description'] ?? ''
    ];

    if (!empty($_FILES['image']['name'])) {
        move_uploaded_file($_FILES['image']['tmp_name'], '../../img/' . $_FILES['image']['name']);
    }

    $product->update($id, $updateData);
    header("Location: ../../admin/dashboard.php?module=produk&page=daftar-produk");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Update Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #333;
            margin-bottom: 10px;
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
        .image-preview img {
            max-width: 100px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Update Produk</h1>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Nama Produk</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($data['name']); ?>" required>
        </div>

        <div class="form-group">
            <label for="category">Kategori</label>
            <select id="category" name="category" required>
                <option value="">-- Pilih Kategori --</option>
                <?php foreach ($kategoriList as $kategori): ?>
                    <option value="<?= $kategori['id_kategori']; ?>" 
                        <?= $data['id_kategori'] == $kategori['id_kategori'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($kategori['nama_kategori']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="price">Harga</label>
            <input type="number" id="price" name="price" value="<?= htmlspecialchars($data['price']); ?>" required>
        </div>

        <div class="form-group">
            <label for="stock">Stok Produk</label>
            <input type="number" id="stock" name="stock" value="<?= htmlspecialchars($data['stock']); ?>" required>
        </div>

        <div class="form-group">
            <label for="image">Gambar Produk</label>
            <input type="file" id="image" name="image" class="file-input">
            <div class="image-preview">
                <?php if (!empty($data['image'])): ?>
                    <img src="../../img/<?= htmlspecialchars($data['image']); ?>" alt="Preview">
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea id="description" name="description"><?= htmlspecialchars($data['description'] ?? ''); ?></textarea>
        </div>

        <button type="submit" class="submit-btn">Simpan Produk</button>
    </form>
</body>
</html>
