<?php
require_once(__DIR__ . '/../../model/About.php');
$about = new About();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];

    if (!empty($judul) && !empty($isi)) {
        $about->insert([
            'judul' => $judul,
            'isi' => $isi
        ]);
        header("Location: ../../admin/dashboard.php?module=about&page=daftar-about");
        exit;
    } else {
        $error = "Judul dan isi tidak boleh kosong.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah About</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 700px;
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
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
            min-height: 150px;
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

<h1>Tambah Tentang Toko Buku</h1>

<?php if (!empty($error)): ?>
  <div class="error"><?= $error; ?></div>
<?php endif; ?>

<form method="post">
    <div class="form-group">
        <label for="judul">Judul</label>
        <input type="text" id="judul" name="judul" required>
    </div>

    <div class="form-group">
        <label for="isi">Isi</label>
        <textarea id="isi" name="isi" required></textarea>
    </div>

    <button type="submit" class="submit-btn">Simpan</button>
</form>

</body>
</html>
