<?php
// Jika Anda ingin menambahkan logika PHP seperti contoh Toko
// require_once(__DIR__ . '/../../model/Contact.php');
// $contact = new Contact();
// $contactData = $contact->getContactInfo();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Hubungi Kami</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fff;
      padding: 40px 45px;
      color: #333;
    }

    .breadcrumb {
      font-size: 14px;
      color: #555;
      margin-bottom: 16px;
    }

    .breadcrumb a {
      color: #000;
      text-decoration: underline;
      margin-right: 4px;
    }

    .hero-banner {
      width: 100%;
      max-height: 250px;
      overflow: hidden;
      border-radius: 12px;
      margin-bottom: 30px;
    }

    .hero-banner img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    h2 {
      font-size: 28px;
      margin-bottom: 20px;
      color: #000;
      font-weight: bold;
    }

    .contact-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      max-width: 800px;
      margin: 0 auto;
    }

    .contact-options {
      display: grid;
      grid-template-columns: 1fr;
      gap: 20px;
      width: 100%;
    }

    .contact-card {
      display: flex;
      align-items: center;
      background-color: #fff;
      padding: 24px;
      border-radius: 16px;
      border: 1px solid #eee;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
      gap: 20px;
    }

    .contact-icon {
      width: 80px;
      height: 80px;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #f0f0f0;
      border-radius: 12px;
    }

    .contact-icon i {
      font-size: 32px;
      color:#0055b7;
    }

    .contact-info {
      flex: 1;
    }

    .contact-info h3 {
      margin: 0;
      font-size: 18px;
      font-weight: bold;
      color: #000;
    }

    .contact-info p {
      margin: 5px 0;
      font-size: 14px;
      color: #333;
    }

    .contact-button {
      display: inline-block;
      background-color:#0055b7;
      color: white;
      padding: 8px 16px;
      text-decoration: none;
      border-radius: 4px;
      font-size: 14px;
      font-weight: 500;
      transition: background-color 0.2s;
    }

    .contact-button:hover {
      background-color:rgb(2, 77, 163);
    }

    .service-hours {
      font-size: 13px;
      color: #666;
      margin-top: 5px;
    }

    @media screen and (max-width: 600px) {
      .contact-card {
        flex-direction: column;
        text-align: center;
      }
      
      .contact-icon {
        margin-bottom: 15px;
      }
    }
  </style>
</head>
<body>

  <div class="breadcrumb">
    <a href="#">Home</a> &gt; Hubungi Kami
  </div>

  <div class="hero-banner">
    <img src="img/contact-banner.jpg" alt="Hubungi Kami Banner" loading="lazy" />
  </div>

  <div class="contact-container">
    <h2>Hubungi Kami</h2>
    
    <div class="contact-options">
      <div class="contact-card">
        <div class="contact-icon">
          <i class="fas fa-comment-dots"></i>
        </div>
        <div class="contact-info">
          <h3>Live Chat</h3>
          <p>Melayani pada pukul 08:00 - 17:00 WIB</p>
          <a href="#" class="contact-button">Chat Sekarang</a>
        </div>
      </div>
      
      <div class="contact-card">
        <div class="contact-icon">
          <i class="fas fa-envelope"></i>
        </div>
        <div class="contact-info">
          <h3>Email</h3>
          <p>Alamat email: CustomerCareGramedia@gmail.com</p>
          <p class="service-hours">Melayani pada pukul 08:00 - 17:00 WIB</p>
          <a href="mailto:castamencare@gramedia.id" class="contact-button">Kirim Email</a>
        </div>
      </div>
    </div>
  </div>

</body>
</html>