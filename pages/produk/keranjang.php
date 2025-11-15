<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once(__DIR__ . '/../../model/Product.php');
$produkModel = new Product();

// Logika tambah, kurang, hapus dari keranjang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = (int) $_POST['product_id'];
    $action = $_POST['action'] ?? 'add';
    $product = $produkModel->getById($product_id);

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if ($product) {
        switch ($action) {
            case 'add':
            case 'increase':
                if (isset($_SESSION['cart'][$product_id])) {
                    $_SESSION['cart'][$product_id]['quantity']++;
                } else {
                    $_SESSION['cart'][$product_id] = [
                        'id' => $product['id'],
                        'name' => $product['name'],
                        'price' => $product['price'],
                        'image' => $product['image'],
                        'quantity' => 1
                    ];
                }
                break;

            case 'decrease':
                if (isset($_SESSION['cart'][$product_id])) {
                    $_SESSION['cart'][$product_id]['quantity']--;
                    if ($_SESSION['cart'][$product_id]['quantity'] <= 0) {
                        unset($_SESSION['cart'][$product_id]);
                    }
                }
                break;

            case 'remove':
                unset($_SESSION['cart'][$product_id]);
                break;
        }
    }

    // Redirect kembali ke halaman keranjang
    header("Location: " . htmlspecialchars($_SERVER['PHP_SELF']));
    exit;
}

// Hitung total
$cart_items = $_SESSION['cart'] ?? [];
$total_price = 0;
$total_quantity = 0;

foreach ($cart_items as $item) {
    $total_price += $item['price'] * $item['quantity'];
    $total_quantity += $item['quantity'];
}

$discount = 0;
$subtotal = $total_price - $discount;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .cart-item {
            background: white;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            gap: 15px;
            align-items: center;
        }
        .cart-item img {
            width: 80px;
            height: 100px;
            object-fit: cover;
            border-radius: 4px;
        }
        .item-info {
            flex: 1;
        }
        .item-info .name {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 5px;
        }
        .item-info .qty, .item-info .price {
            font-size: 14px;
            margin-bottom: 5px;
        }
        .item-info form {
            display: inline;
            margin-right: 5px;
        }
        .item-info button {
            padding: 4px 8px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-action {
            background-color: #2e7d32;
            color: white;
        }
        .btn-remove {
            background-color: #c62828;
            color: white;
        }
        .summary {
            background: white;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .summary .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .subtotal {
            border-top: 1px solid #ccc;
            margin-top: 10px;
            padding-top: 10px;
            font-weight: bold;
        }
        .checkout-btn {
            display: inline-block;
            margin-top: 20px;
            background-color: #2E7D32;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
        }
    </style>
</head>
<body>

<h1>Keranjang Belanja</h1>

<?php if (empty($cart_items)): ?>
    <p>Keranjang kosong.</p>
<?php else: ?>
    <?php foreach ($cart_items as $item): ?>
        <div class="cart-item">
            <img src="/img/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
            <div class="item-info">
                <div class="name"><?= htmlspecialchars($item['name']) ?></div>
                <div class="qty">
                    Jumlah: <?= $item['quantity'] ?>
                    <!-- Tombol + -->
                    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                        <button type="submit" name="action" value="increase" class="btn-action">+</button>
                    </form>
                    <!-- Tombol - -->
                    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                        <button type="submit" name="action" value="decrease" class="btn-action">-</button>
                    </form>
                </div>
                <div class="price">Harga: Rp<?= number_format($item['price'], 0, ',', '.') ?></div>
                <!-- Tombol Hapus -->
                <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return confirm('Yakin ingin menghapus item ini?');">
                    <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                    <button type="submit" name="action" value="remove" class="btn-remove">Hapus</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<!-- Ringkasan -->
<div class="summary">
    <div class="row">
        <span>Total Barang</span>
        <span><?= $total_quantity ?> item</span>
    </div>
    <div class="row">
        <span>Total Harga</span>
        <span>Rp<?= number_format($total_price, 0, ',', '.') ?></span>
    </div>
    <div class="row">
        <span>Diskon</span>
        <span>-Rp<?= number_format($discount, 0, ',', '.') ?></span>
    </div>
    <div class="row subtotal">
        <span>Subtotal</span>
        <span>Rp<?= number_format($subtotal, 0, ',', '.') ?></span>
    </div>
    <a href="checkout.php" class="checkout-btn">Checkout</a>
</div>

</body>
</html>
