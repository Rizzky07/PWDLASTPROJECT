<?php
session_start();

if (!isset($_SESSION['level'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['level'] == 0) {
    // Admin, lanjut ke dashboard.php
} elseif ($_SESSION['level'] == 1) {
    header("Location: ../index.php");
    exit();
} else {
    header("Location: unauthorized.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>::. Administrator .::</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/font-awesome/css/all.min.css">

  <style>
    * {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
  display: flex;
  min-height: 100vh;
  background-color: #f4f6f9;
  color: #333;
}

#wrapper {
  display: flex;
  width: 100%;
  transition: all 0.3s ease;
}

#sidebar-wrapper {
  width: 250px;
  min-height: 100vh;
  background: linear-gradient(180deg,rgb(9, 133, 227), #212529);
  color: white;
  flex-shrink: 0;
  transition: margin-left 0.3s ease;
  box-shadow: 2px 0 10px rgba(0,0,0,0.2);
}

#wrapper.toggled #sidebar-wrapper {
  margin-left: -250px;
}

.sidebar-heading {
  font-size: 1.6em;
  font-weight: bold;
  padding: 20px;
  background:rgb(27, 134, 215);
  text-align: center;
  letter-spacing: 1px;
  text-transform: uppercase;
}

.list-group a {
  display: block;
  padding: 15px 20px;
  color: #f8f9fa;
  text-decoration: none;
  border-bottom: 1px solid rgba(255,255,255,0.1);
  transition: background 0.3s, padding-left 0.3s;
}

.list-group a i {
  margin-right: 10px;
}

.list-group a:hover {
  background:rgb(14, 72, 130);
  padding-left: 25px;
}

#page-content-wrapper {
  flex-grow: 1;
  transition: all 0.3s ease;
  background-color: #fff;
}

nav.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: #ffffff;
  padding: 15px 20px;
  border-bottom: 1px solid #dee2e6;
  box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.navbar .btn {
  background: none;
  border: none;
  cursor: pointer;
  font-size: 20px;
  color: #343a40;
}

.nav-item {
  position: relative;
}

.nav-link {
  cursor: pointer;
  color: #343a40;
  font-weight: 500;
  text-decoration: none;
  display: flex;
  align-items: center;
}

.nav-link i {
  margin-left: 6px;
}

.dropdown-menu {
  display: none;
  position: absolute;
  right: 0;
  background: #ffffff;
  border: 1px solid #ccc;
  margin-top: 10px;
  min-width: 160px;
  border-radius: 4px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  z-index: 1000;
}

.dropdown-menu.show {
  display: block;
}

.dropdown-item {
  padding: 10px 15px;
  color: #333;
  text-decoration: none;
  display: block;
  font-size: 14px;
}

.dropdown-item:hover {
  background: #f8f9fa;
  color: #007bff;
}

.container-fluid {
  padding: 25px;
  background-color: #f8f9fa;
  min-height: 100vh;
}

  </style>
</head>
<body>
  <div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <div class="sidebar-heading">Gramedia</div>
      <div class="list-group">
        <a href="dashboard.php" class="active"><i class="fa-solid fa-house"></i>Dashboard</a>
        <a href="dashboard.php?module=produk&page=daftar-produk"><i class="fas fa-info-circle"></i> Produk</a>
        <a href="dashboard.php?module=artikel&page=daftar-artikel"><i class="fas fa-box-open"></i> Artikel</a>
        <a href="dashboard.php?module=about&page=daftar-about"><i class="fas fa-shopping-cart"></i> Keranjang</a>
      </div>
    </div>

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <nav class="navbar">
        <button class="btn" id="menu-toggle">☰</button>
        <div class="nav-item">
          <a class="nav-link" id="admin-toggle"></i>👤 Admin <i class="fas fa-caret-down" style="margin-left: 5px;"></i></a>
          <div class="dropdown-menu" id="admin-dropdown">
            <a class="dropdown-item" href="#"><i class="fas fa-edit"></i> Profile</a>
            <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </div>
        </div>
      </nav>

      <div class="container-fluid">
        <?php 
          $page = 'page/dashboard-main.php';
          if (isset($_GET['module']) && isset($_GET['page'])) {
            $page = 'page/' . $_GET['module'] . '/' . $_GET['page'] . '.php';
          }
          require($page);
        ?>
      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="../assets/js/jquery-3.4.1.slim.min.js"></script>
  <script>
    // Toggle sidebar
    document.getElementById("menu-toggle").addEventListener("click", function(e) {
      e.preventDefault();
      document.getElementById("wrapper").classList.toggle("toggled");
    });

    // Toggle Admin dropdown
    document.getElementById("admin-toggle").addEventListener("click", function (e) {
      e.preventDefault();
      document.getElementById("admin-dropdown").classList.toggle("show");
    });

    // Close dropdown if click outside
    document.addEventListener("click", function (e) {
      const dropdown = document.getElementById("admin-dropdown");
      const toggle = document.getElementById("admin-toggle");
      if (!dropdown.contains(e.target) && !toggle.contains(e.target)) {
        dropdown.classList.remove("show");
      }
    });
  </script>
</body>
</html>
