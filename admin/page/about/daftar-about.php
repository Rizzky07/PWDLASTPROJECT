<h2 class="mt-4 mb-4"><i class="fas fa-shopping-cart"></i> Keranjang</h2>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Keranjang</title>
  <style>
    
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .cart-container {
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      padding: 40px;
      max-width: 400px;
      width: 100%;
      text-align: center;
    }

    .cart-container h2 {
      color: #333;
      margin-bottom: 10px;
    }

    .cart-container p {
      color: #777;
      font-size: 16px;
      margin-bottom: 30px;
    }

    .cart-icon {
      font-size: 64px;
      color: #adb5bd;
      margin-bottom: 20px;
    }

    .btn-katalog {
      display: inline-block;
      padding: 12px 24px;
      background-color: #007BFF;
      color: white;
      border: none;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }

    .btn-katalog:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="cart-container">
    <div class="cart-icon">🛒</div>
    <h2>Keranjang Kamu Kosong</h2>
    <p>Ayo lihat katalog dan temukan produk yang kamu suka.</p>
    <a href="../artikel/daftar-artikel.php" class="btn-katalog">Lihat Katalog</a>
  </div>
</body>
</html>
