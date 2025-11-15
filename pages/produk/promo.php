<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Promo & Info</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 40px;
    }

    h2 {
      font-size: 28px;
      margin-bottom: 10px;
      color: #333;
    }

    .breadcrumb {
      font-size: 14px;
      color: #777;
      margin-bottom: 30px;
    }

    .promo-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      gap: 24px;
    }

    .promo-card {
      background: #fff;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
      transition: transform 0.2s ease;
      position: relative;
      display: flex;
      flex-direction: column;
    }

    .promo-card:hover {
      transform: translateY(-4px);
    }

    .promo-image {
      width: 100%;
      height: 180px;
      object-fit: cover;
      display: block;
    }

    .promo-content {
      padding: 16px;
    }

    .promo-title {
      font-size: 15px;
      font-weight: 600;
      color: #212529;
      margin-bottom: 6px;
    }

    .promo-date {
      font-size: 13px;
      color: #6c757d;
    }

    /* Optional jika nanti ada label */
    .label {
      position: absolute;
      top: 12px;
      right: 12px;
      background: #007bff;
      color: white;
      font-size: 11px;
      padding: 4px 8px;
      border-radius: 6px;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <div class="breadcrumb">Home &gt; Promo & Info</div>
  <h2>Promo & Info</h2>

  <?php
  require_once(__DIR__ . '/../../model/Promo.php');
  $promo = new Promo();
  $dataPromo = $promo->getAll(); // Ambil semua data promo
  ?>

  <?php if (empty($dataPromo)): ?>
    <p>Tidak ada promo tersedia saat ini.</p>
  <?php else: ?>
    <div class="promo-grid">
      <?php foreach ($dataPromo as $row): ?>
        <?php
          $image = htmlspecialchars($row['image'] ?? 'default.jpg');
          $judul = htmlspecialchars($row['nama_promo'] ?? '(Tanpa Judul)');
          $tgl_mulai = $row['tanggal_mulai'] ?? null;
          $tgl_akhir = $row['tanggal_berakhir'] ?? null;
        ?>
        <div class="promo-card">
          <img src="../../img/<?= $image; ?>" class="promo-image" alt="<?= $judul; ?>">
          <div class="promo-content">
            <div class="promo-title"><?= $judul; ?></div>
            <?php if (!empty($tgl_mulai) && !empty($tgl_akhir)): ?>
              <div class="promo-date">
                <?= date("j", strtotime($tgl_mulai)) . ' - ' . date("j F Y", strtotime($tgl_akhir)) ?>
              </div>
            <?php else: ?>
              <div class="promo-date">Tanggal tidak tersedia</div>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

</body>
</html>
