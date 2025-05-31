<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Tambah Produk</title>
  <link rel="stylesheet" href="../asset/daftar-artikel.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
  />
  <style>
    .form-wrapper {
      max-width: 600px;
      margin: 20px auto;
      background: #1e1e1e;
      padding: 20px;
      border-radius: 10px;
      color: #f9fafb;
      box-shadow: 0 1px 5px rgba(0, 0, 0, 0.5);
    }

    .form-wrapper h2 {
      margin-bottom: 20px;
      font-weight: 600;
      font-size: 24px;
      color: #e5e7eb;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 500;
      color: #9ca3af;
    }

    input[type="text"],
    input[type="file"],
    textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 16px;
      border-radius: 6px;
      border: 1px solid #333;
      background: #252525;
      color: #f9fafb;
      font-size: 14px;
      box-sizing: border-box;
    }

    input[type="text"]:focus,
    textarea:focus,
    input[type="file"]:focus {
      border-color: #3b82f6;
      outline: none;
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
    }

    textarea {
      min-height: 100px;
      resize: vertical;
    }

    button[type="submit"] {
      background-color: #2563eb;
      border: none;
      padding: 12px 16px;
      color: white;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 600;
      font-size: 16px;
      width: 100%;
      transition: background-color 0.2s;
    }

    button[type="submit"]:hover {
      background-color: #1d4ed8;
    }

    .back-link {
      display: inline-block;
      margin-bottom: 20px;
      color: #3b82f6;
      text-decoration: none;
      font-weight: 600;
    }

    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="form-wrapper">
  <a href="index.php" class="back-link"><i class="fas fa-arrow-left"></i> Kembali</a>
  <h2><i class="fas fa-plus"></i> Tambah Produk</h2>

  <form method="post" enctype="multipart/form-data">
    <label for="name">Nama Produk</label>
    <input id="name" type="text" name="name" required />

    <label for="category">Kategori</label>
    <input id="category" type="text" name="category" required />

    <label for="price">Harga</label>
    <input id="price" type="text" name="price" required />

    <label for="cover">Gambar</label>
    <input id="cover" type="file" name="cover" accept="image/png, image/jpg, image/jpeg" required />

    <label for="description">Deskripsi</label>
    <textarea id="description" name="description" placeholder="Tambahkan deskripsi produk" required></textarea>

    <button type="submit" name="submit">Simpan Produk</button>
  </form>

  <?php
    require_once '../model/Product.php';
    $produk = new Product();

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        // Upload file gambar dengan validasi sederhana
        $cover = $_FILES['cover']['name'];
        $file_tmp = $_FILES['cover']['tmp_name'];
        $file_type = $_FILES['cover']['type'];

        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];
        $upload_dir = "../img/";
        $upload_file = $upload_dir . basename($cover);

        if (in_array($file_type, $allowed_types)) {
            if (move_uploaded_file($file_tmp, $upload_file)) {
                // Simpan data produk ke database
                $data = [
                    'name' => $name,
                    'category' => $category,
                    'price' => $price,
                    'description' => $description,
                    'image' => $cover
                ];

                $insert = $produk->addProduct($data);

                if ($insert) {
                    echo "<script>alert('Data Berhasil Disimpan'); window.location.href='index.php';</script>";
                } else {
                    echo "<script>alert('Gagal menyimpan data ke database.');</script>";
                }
            } else {
                echo "<script>alert('Gagal upload gambar!');</script>";
            }
        } else {
            echo "<script>alert('Tipe file tidak diperbolehkan!');</script>";
        }
    }
  ?>
</div>

</body>
</html>
