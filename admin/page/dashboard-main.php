<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="../asset/dashboard.css">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</head>
<body>

  <h2 class="dashboard-title"><i class="fas fa-tachometer-alt"></i> Dashboard</h2>

  <div class="alert-box">
    <strong>Hi,</strong> Selamat Datang Admin
    <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
  </div>

  <div class="dashboard-cards">
    <div class="card card-blue">
      <div class="card-info">
        <div class="card-title">Artikel</div>
        <div class="card-count">0</div>
      </div>
      <div class="card-icon"><i class="fas fa-newspaper"></i></div>
    </div>

    <div class="card card-yellow">
      <div class="card-info">
        <div class="card-title">Produk</div>
        <div class="card-count">0</div>
      </div>
      <div class="card-icon"><i class="fas fa-address-card"></i></div>
    </div>

    <div class="card card-green">
      <div class="card-info">
        <div class="card-title">Layanan</div>
        <div class="card-count">0</div>
      </div>
      <div class="card-icon"><i class="fas fa-wrench"></i></div>
    </div>
  </div>

</body>
</html>
