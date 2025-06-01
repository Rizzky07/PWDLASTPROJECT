<?php
require_once('../../model/Product.php');
$product = new Product();
$id = $_GET['id'];
$data = $product->getById($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $updateData = [
        'name' => $_POST['name'],
        'category' => $_POST['category'],
        'price' => $_POST['price'],
        'image' => !empty($_FILES['image']['name']) ? $_FILES['image']['name'] : $data['image'],
        'description' => $_POST['description'] ?? '' // Tambahkan ini jika ingin menyimpan deskripsi
    ];

    if (!empty($_FILES['image']['name'])) {
        move_uploaded_file($_FILES['image']['tmp_name'], '../../img/' . $_FILES['image']['name']);
    }

    $product->update($id, $updateData);
    header("Location: ../../admin/page/produk/daftar-produk.php");
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
            margin-bottom: 10px;
        }
        h2 {
            color: #333;
            margin: 20px 0 10px 0;
            font-size: 1.2em;
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
        textarea {
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
        .divider {
            border-top: 1px solid #eee;
            margin: 20px 0;
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
    <h1>Update Buku</h1>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Nama Produk</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($data['name']); ?>" required>
        </div>

        <div class="divider"></div>

        <h2>Kategori</h2>
        <div class="form-group">
            <input type="text" id="category" name="category" value="<?= htmlspecialchars($data['category']); ?>" required>
        </div>

        <div class="form-group">
            <label for="price">Harga</label>
            <input type="number" id="price" name="price" value="<?= htmlspecialchars($data['price']); ?>" required>
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

        <div class="divider"></div>

        <h2>Deskripsi</h2>
        <div class="form-group">
            <textarea id="description" name="description" placeholder="Tambahkan deskripsi untuk produk ini"><?= htmlspecialchars($data['description'] ?? ''); ?></textarea>
        </div>

        <div class="divider"></div>

        <button type="submit" class="submit-btn">Simpan Produk</button>
    </form>
</body>
</html>