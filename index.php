<?php
// session_start();

// // Hitung total item di keranjang dari session 'cart'
// $total_keranjang = 0;
// if (!empty($_SESSION['cart']) && is_array($_SESSION['cart'])) {
//     foreach ($_SESSION['cart'] as $item) {
//         if (isset($item['quantity'])) {
//             $total_keranjang += $item['quantity'];
//         }
//     }
// }
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>::. Administrator .::</title>

<link rel="stylesheet" href="../assets/font-awesome/css/all.min.css">
<link rel="stylesheet" href="style.css">

<!-- <style>
/* RESET */
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:"Segoe UI",sans-serif;
}

body{
  background:#f5f7fb;
  display:flex;
}

/*==============================
  SIDEBAR CLOUDIFY
==============================*/
.sidebar{
  width:260px;
  background:#ffffff;
  height:100vh;
  padding:25px 20px;
  position:fixed;
  left:0;
  top:0;
  box-shadow:3px 0 10px rgba(0,0,0,0.05);
}

.logo{
  text-align:center;
  margin-bottom:25px;
}

.logo img{
  width:80px;
}

.btn-new{
  display:block;
  width:100%;
  background:#fff;
  border:1px solid #e0e0e0;
  padding:12px;
  border-radius:10px;
  box-shadow:0 2px 4px rgba(0,0,0,0.05);
  font-weight:600;
  margin-bottom:25px;
  text-align:center;
  text-decoration:none;
  color:#000;
}

.menu{
  list-style:none;
  padding:0;
}

.menu li{
  display:flex;
  align-items:center;
  gap:12px;
  padding:12px;
  border-radius:10px;
  cursor:pointer;
  margin-bottom:5px;
  font-size:15px;
  color:#444;
  transition:.2s;
}

.menu li:hover,
.menu li.active{
  background:#e7f0ff;
  color:#4285f4;
}

.menu i{
  width:20px;
  text-align:center;
}

/* STORAGE BOX */
.storage{
  margin-top:30px;
}

.progress{
  width:100%;
  height:8px;
  background:#ddd;
  border-radius:20px;
  position:relative;
}

.progress::after{
  content:"";
  width:35%;
  height:100%;
  background:#4285f4;
  border-radius:20px;
  position:absolute;
}

.storage p{
  margin-top:5px;
  font-size:13px;
  color:#555;
  text-align:left;
}

/*==============================
  MAIN CONTENT
==============================*/
.main{
  margin-left:260px;
  width:calc(100% - 260px);
  padding:20px;
}

/*==============================
  TOP HEADER
==============================*/
.top-header{
  position: fixed;
  top: 0;
  left: 260px; /* mengikuti sidebar */
  width: calc(100% - 260px);
  background: #f5f7fb;
  padding: 20px 20px;
  z-index: 99;
  box-shadow: 0 3px 10px rgba(0,0,0,0.05);
  /* display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:25px; */
}

.search-box{
  width:65%;
  position:relative;
}

.search-box input{
  width:100%;
  padding:14px 50px;
  border-radius:30px;
  border:1px solid #ccc;
  font-size:15px;
  background:#fff;
}

.search-box i{
  position:absolute;
  top:12px;
  left:20px;
  font-size:18px;
  color:#666;
}

.header-right{
  display:flex;
  align-items:center;
  gap:20px;
}

.header-icon{
  width:45px;
  height:45px;
  border-radius:50%;
  background:#eef1ff;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:20px;
  cursor:pointer;
}

.header-icon:hover{
  background:#dde3ff;
}

.username{
  font-weight:600;
}

/* CONTENT WRAPPER */
.content-wrapper{
  padding-top:100px;
} -->
<!-- </style> -->
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <div class="logo">
    <img src="img/Logo Cloudify.png">
    <!-- <h3 style="margin-top:10px;">CLOUDIFY</h3> -->
  </div>

  <a href="#" class="btn-new"><i class="fa fa-plus"></i> Baru</a>

  <ul class="menu">
    <li class="active"><i class="fa fa-house"></i> Beranda</li>
    <li><i class="fa fa-cloud"></i> Cloud Saya</li>
    <li><i class="fa fa-clock"></i> Terbaru</li>
    <li><i class="fa fa-star"></i> Favorit</li>
    <li><i class="fa fa-trash"></i> Sampah</li>
    <li><i class="fa fa-database"></i> Penyimpanan</li>
  </ul>

  <div class="storage">
    <div class="progress"></div>
    <p>1.9 GB dari 6 GB Terpakai</p>
  </div>
</div>

<!-- MAIN -->
<div class="main">

  <!-- HEADER -->
  <div class="top-header">

  <div class="search-box">
    <input type="text" placeholder="Telusuri file">
    <i class="fa fa-search"></i>
    <i class="fa fa-sliders-h"></i>
  </div>

  <div class="header-right">
    <div class="header-icon"><i class="fa fa-gear"></i></div>
    <div class="header-icon user"><i class="fa fa-user"></i></div>
  </div>

</div>

  <!-- PAGE CONTENT -->
  <div class="content-wrapper">
    <?php 
      $page = 'pages/Menu-Utama.php';
      if (isset($_GET['module']) && isset($_GET['page'])) {
        $page = 'page/' . $_GET['module'] . '/' . $_GET['page'] . '.php';
      }
      require($page);
    ?>
  </div>

</div>

</body>
</html>