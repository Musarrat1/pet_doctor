<?php
include 'db.php';

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$sql = "SELECT * FROM products";
if ($search !== '') {
  $sql .= " WHERE name LIKE '%$search%'";
}
$sql .= " ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Pet Paradise - Shop</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-50">
  <header class="bg-white shadow-lg p-4">
    <h1 class="text-2xl font-bold">Pet House</h1>
  </header>

  <main class="container mx-auto px-4 py-8">
    <form method="GET" class="mb-6 flex gap-2">
      <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search products..." class="border px-3 py-2 rounded w-full max-w-md" />
      <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Search</button>
    </form>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <?php if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { ?>
          <div class="bg-white rounded-xl shadow-md hover:shadow-lg overflow-hidden">
            <div class="relative h-48">
              <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="w-full h-full object-cover" />
              <?php if ($row['is_new']) { ?>
                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">NEW</span>
              <?php } ?>
            </div>
            <div class="p-4">
              <div class="flex justify-between items-start">
                <h3 class="font-semibold text-lg"><?php echo htmlspecialchars($row['name']); ?></h3>
                <span class="text-purple-600 font-bold">TK-<?php echo number_format($row['price'], 2); ?></span>
              </div>
              <p class="text-gray-500 text-sm mt-2"><?php echo htmlspecialchars($row['description']); ?></p>
              <div class="mt-3">
                <button class="bg-purple-500 text-white p-2 rounded-full hover:bg-purple-400">
                  <i class="fas fa-shopping-cart"></i>
                </button>
              </div>
            </div>
          </div>
      <?php }
      } else {
        echo "<p>No products found.</p>";
      }
      $conn->close();
      ?>
    </div>
  </main>
</body>
</html>
