<?php
session_start();
include 'db.php';

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    echo "No items in cart.";
    exit();
}

// Save purchases
foreach ($cart as $product_id => $quantity) {
    $stmt = $conn->prepare("INSERT INTO purchases (user_id, product_id, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $user_id, $product_id, $quantity);
    $stmt->execute();
}

unset($_SESSION['cart']); 
?>

<!DOCTYPE html>
<html>
<head>
  <title>Payment Success</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 flex items-center justify-center h-screen">
  <div class="bg-white p-8 rounded shadow-lg text-center">
    <h2 class="text-2xl font-bold text-green-600 mb-4">Payment Successful!</h2>
    <p class="mb-6">Thank you for your purchase. Your items will be shipped soon.</p>
    <a href="store.php" class="inline-block bg-[#FFB22C] text-white px-6 py-3 rounded hover:bg-[#FA812F]">Continue Shopping</a>
  </div>
</body>
</html>
