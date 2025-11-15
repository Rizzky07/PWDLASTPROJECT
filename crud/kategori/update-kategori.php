<?php
require_once('../../model/Kategori.php');
$kategori = new Kategori();
$id = $_GET['id'];
$data = $kategori->getById($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_kategori = $_POST['nama_kategori'];

    if (!empty($nama_kategori)) {
        $kategori->update($id, ['nama_kategori' => $nama_kategori]);
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
    <title>Update Kategori</title>
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
            margin-top: 10px;
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

<h1>Update Kategori</h1>

<?php if (!empty($error)): ?>
  <div class="error"><?= $error; ?></div>
<?php endif; ?>

<form method="post">
    <div class="form-group">
        <label for="nama_kategori">Nama Kategori</label>
        <input type="text" id="nama_kategori" name="nama_kategori" value="<?= htmlspecialchars($data['nama_kategori']); ?>" required>
    </div>

    <button type="submit" class="submit-btn">Simpan Perubahan</button>
</form>

</body>
</html>
