<?php
include 'db.php';

if (!isset($_GET['id'])) {
    die("Product ID is missing.");
}

$id = intval($_GET['id']);
$product = $conn->query("SELECT * FROM products WHERE id = $id")->fetch_assoc();

if (!$product) {
    die("Product not found.");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add to Cart</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
  <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <div class="flex items-center space-x-6">
      <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-40 h-40 object-cover rounded" />
      <div>
        <h2 class="text-2xl font-bold mb-2"><?= htmlspecialchars($product['name']) ?></h2>
        <p class="text-gray-700 mb-2"><?= htmlspecialchars($product['description']) ?></p>
        <p class="text-yellow-600 font-bold text-lg mb-4">TK-<?= number_format($product['price'], 2) ?></p>
       <form action="checkout.php" method="POST">
  <input type="hidden" name="product_id" value="<?= $product['id'] ?>" />
  <label class="block mb-2">Quantity:</label>
  <input type="number" name="quantity" value="1" min="1" class="w-20 p-2 border rounded mb-4" required />
  <button type="submit" class="bg-[#FFB22C] text-black px-4 py-2 rounded hover:bg-[#FFB22C]">
    Add to Cart
  </button>
</form>

      </div>
    </div>
  </div>
</body>
</html>
