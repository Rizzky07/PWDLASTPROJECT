<?php
require_once(__DIR__ . '/../../model/Kategori.php');
$kategori = new Kategori();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_kategori'];

    if (!empty($nama)) {
        $kategori->insert(['nama_kategori' => $nama]);
        header("Location: ../../admin/dashboard.php?module=kategori&page=daftar-kategori");
        exit;
    } else {
        $error = "Nama kategori tidak boleh kosong.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori</title>
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
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<h1>Tambah Kategori</h1>

<?php if (!empty($error)): ?>
  <div class="error"><?= $error; ?></div>
<?php endif; ?>

<form method="post">
    <div class="form-group">
        <label for="nama_kategori">Nama Kategori</label>
        <input type="text" id="nama_kategori" name="nama_kategori" required>
    </div>

    <button type="submit" class="submit-btn">Simpan Kategori</button>
</form>

</body>
</html>
