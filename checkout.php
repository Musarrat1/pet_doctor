<?php
session_start();
include 'db.php';

// Add product to session cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);
    $quantity = max(1, intval($_POST['quantity']));

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // If item already in cart, update quantity
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }
}

// Fetch product details
$cart_items = [];
$total = 0;

if (!empty($_SESSION['cart'])) {
    $ids = implode(",", array_keys($_SESSION['cart']));
    $result = $conn->query("SELECT * FROM products WHERE id IN ($ids)");

    while ($row = $result->fetch_assoc()) {
        $pid = $row['id'];
        $qty = $_SESSION['cart'][$pid];
        $subtotal = $qty * $row['price'];
        $total += $subtotal;

        $cart_items[] = [
            'id' => $pid,
            'name' => $row['name'],
            'price' => $row['price'],
            'quantity' => $qty,
            'image' => $row['image'],
            'subtotal' => $subtotal,
        ];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Checkout</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
  <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6">Your Cart</h2>

    <?php if (empty($cart_items)): ?>
      <p>Your cart is empty.</p>
    <?php else: ?>
      <div class="space-y-4">
        <?php foreach ($cart_items as $item): ?>
          <div class="flex items-center justify-between border-b pb-4">
            <div class="flex items-center space-x-4">
              <img src="<?= htmlspecialchars($item['image']) ?>" class="w-16 h-16 object-cover rounded" />
              <div>
                <h3 class="font-semibold"><?= htmlspecialchars($item['name']) ?></h3>
                <p>Quantity: <?= $item['quantity'] ?> × $<?= number_format($item['price'], 2) ?></p>
              </div>
            </div>
            <div class="font-bold text-green-600">$<?= number_format($item['subtotal'], 2) ?></div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="mt-6 text-right text-xl font-bold text-yellow-700">
        Total: $<?= number_format($total, 2) ?>
      </div>

      <form action="payment_success.php" method="POST" class="mt-6 text-right">
        <button type="submit" class="bg-[#FFB22C] text-white px-6 py-3 rounded hover:bg-[#FA812F]">
          Proceed to Payment
        </button>
      </form>
    <?php endif; ?>
  </div>
</body>
</html>
