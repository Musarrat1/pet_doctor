<?php
include 'db.php';

if (!isset($_GET['id'])) {
    die("Product ID not provided.");
}

$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = floatval($_POST['price']);
    $image = $conn->real_escape_string($_POST['image']);
    $is_new = isset($_POST['is_new']) ? 1 : 0;

    $sql = "UPDATE products SET name='$name', description='$description', price=$price, image='$image', is_new=$is_new WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: add_product.php");
    } else {
        echo "❌ Error updating product: " . $conn->error;
    }
}

$product = $conn->query("SELECT * FROM products WHERE id = $id")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Product</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">
  <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4">Edit Product</h2>
    <form method="POST">
      <label class="block mb-2">Name:</label>
      <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required class="w-full mb-4 border p-2 rounded" />

      <label class="block mb-2">Description:</label>
      <textarea name="description" required class="w-full mb-4 border p-2 rounded"><?= htmlspecialchars($product['description']) ?></textarea>

      <label class="block mb-2">Price:</label>
      <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required class="w-full mb-4 border p-2 rounded" />

      <label class="block mb-2">Image URL:</label>
      <input type="text" name="image" value="<?= htmlspecialchars($product['image']) ?>" required class="w-full mb-4 border p-2 rounded" />

      <label class="inline-flex items-center mb-4">
        <input type="checkbox" name="is_new" <?= $product['is_new'] ? 'checked' : '' ?> class="mr-2" /> Is New Product?
      </label><br>

      <button type="submit" class="bg-[#FFB22C] text-white px-4 py-2 rounded hover:bg-blue-700">Update Product</button>
    </form>
  </div>
</body>
</html>
