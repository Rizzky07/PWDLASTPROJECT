<?php
require_once(__DIR__ . '/../../model/About.php');
$about = new About();

// Ambil ID dari URL
if (!isset($_GET['id'])) {
    header("Location: ../../admin/dashboard.php?module=about&page=daftar-about");
    exit;
}

$id = intval($_GET['id']);
$data = $about->getById($id);

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}

// Proses update jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];

    if (!empty($judul) && !empty($isi)) {
        $about->update($id, [
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
    <title>Edit About</title>
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
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<h1>Edit Tentang Toko Buku</h1>

<?php if (!empty($error)): ?>
  <div class="error"><?= $error; ?></div>
<?php endif; ?>

<form method="post">
    <div class="form-group">
        <label for="judul">Judul</label>
        <input type="text" id="judul" name="judul" value="<?= htmlspecialchars($data['judul']); ?>" required>
    </div>

    <div class="form-group">
        <label for="isi">Isi</label>
        <textarea id="isi" name="isi" required><?= htmlspecialchars($data['isi']); ?></textarea>
    </div>

    <button type="submit" class="submit-btn">Update</button>
</form>

</body>
</html>
