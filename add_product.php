<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = floatval($_POST['price']);
    $image = $conn->real_escape_string($_POST['image']);
    $is_new = isset($_POST['is_new']) ? 1 : 0;

    $sql = "INSERT INTO products (name, description, price, image, is_new) VALUES ('$name', '$description', $price, '$image', $is_new)";
    if ($conn->query($sql) === TRUE) {
        header("Location: " . $_SERVER['PHP_SELF']); // Refresh page
        exit();
    } else {
        $error_message = "❌ Error: " . $conn->error;
    }
}

// Fetch products
$result = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Product</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">

  <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4">Add New Product</h2>

    <?php if (!empty($error_message)): ?>
      <div class="mb-4 text-red-600 font-semibold"><?= $error_message ?></div>
    <?php endif; ?>

    <form method="POST">
      <label class="block mb-2">Name:</label>
      <input type="text" name="name" required class="w-full mb-4 border p-2 rounded" />

      <label class="block mb-2">Description:</label>
      <textarea name="description" required class="w-full mb-4 border p-2 rounded"></textarea>

      <label class="block mb-2">Price:</label>
      <input type="number" step="0.01" name="price" required class="w-full mb-4 border p-2 rounded" />

      <label class="block mb-2">Image URL:</label>
      <input type="text" name="image" required class="w-full mb-4 border p-2 rounded" />

      <label class="inline-flex items-center mb-4">
        <input type="checkbox" name="is_new" class="mr-2" /> Is New Product?
      </label><br>

      <button type="submit" class="bg-[#FFB22C] text-white px-4 py-2 rounded ">Add Product</button>
    </form>
  </div>

  <?php if ($result->num_rows > 0): ?>
    <div class="mt-10 max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
      <h2 class="text-xl font-bold mb-4">Product List</h2>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="mb-4 border-b pb-2">
          <h3 class="font-semibold"><?= htmlspecialchars($row['name']) ?> - $<?= number_format($row['price'], 2) ?></h3>
          <p class="text-sm"><?= htmlspecialchars($row['description']) ?></p>
          <div class="mt-2">
            <a href="edit_product.php?id=<?= $row['id'] ?>" class="text-[#FFB22C] hover:underline mr-4">Edit</a>
            <a href="delete_product.php?id=<?= $row['id'] ?>" class="text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>

</body>
</html>
