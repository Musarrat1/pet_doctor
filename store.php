
<?php

$conn = new mysqli("localhost", "root", "", "petplace");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Pet Paradise - Shop</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    html {
    scroll-behavior: smooth;
  }
</head>

</style>
<body class="bg-gray-50">


 <header class="text-black bg-white shadow-lg">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <div class="flex items-center space-x-2">
        <h1 class="text-2xl font-bold">Pet House</h1>
      </div>
      <nav class="hidden md:block">
        <ul class="flex space-x-8">
          <li><a href="index.html" class="hover:text-yellow-400 transition">Home</a></li>
          <li><a href="store.php" class="hover:text-yellow-400 transition">Shop</a></li>
          <li><a href="services.php" class="hover:text-yellow-400 transition">Services</a></li>
          <li><a href="index.html" class="hover:text-yellow-400 transition">About</a></li>
          <li><a href="contact.html" class="hover:text-yellow-400 transition">Contact</a></li>
        </ul>
      </nav>
      <div class="flex items-center space-x-4 relative">
        <button
          class="bg-white text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-100 transition shadow-lg"
          onclick="location.href='profile.php'"
        >
          Profile
        </button>
        <span
          class="absolute -top-1 -right-1 bg-petgreen-400 text-xs rounded-full h-5 w-5 flex items-center justify-center text-white font-bold"
          >3</span
        >
        <button class="md:hidden p-2 rounded-full hover:bg-petgreen-600 transition">
          <i class="fas fa-bars"></i>
        </button>
      </div>
    </div>
  </header>
   <section class="bg-gradient-to-r from-yellow-500 to-yellow-300 text-white py-12">
    <div class="container mx-auto px-4">
      <div class="max-w-2xl">
        <h2 class="text-4xl font-bold mb-4">Find Everything Your Pet Needs</h2>
        <p class="text-lg mb-6">
          Premium quality products for your furry, feathery, and scaly friends
        </p>
     <a
  href="#products"
  class="inline-flex items-center border border-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-yellow-500 transition"
>
  Shop Now <i class="fas fa-arrow-right ml-2"></i>
</a>

      </div>
    </div>
  </section>

<main id="products" class="container mx-auto px-4 py-8">

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    <?php while($row = $result->fetch_assoc()): ?>
      <a href="add_to_cart.php?id=<?= $row['id'] ?>" class="block group">
        <div class="product-card bg-white rounded-xl shadow-md overflow-hidden transition duration-300 group-hover:shadow-lg">
          <div class="product-image relative overflow-hidden bg-gray-100 h-48 flex items-center justify-center">
            <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" />
            <?php if ($row['is_new']): ?>
              <div class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">NEW</div>
            <?php endif; ?>
          </div>
          <div class="p-4">
            <h3 class="font-semibold text-lg"><?= htmlspecialchars($row['name']) ?></h3>
            <p class="text-gray-600 mb-2"><?= htmlspecialchars($row['description']) ?></p>
            <span class="text-yellow-600 font-bold">TK-<?= number_format($row['price'], 2) ?></span>
          </div>
        </div>
      </a>
    <?php endwhile; ?>
  </div>
</main>

  <footer class="bg-yellow-600 text-white py-8 mt-16">
    <div class="container mx-auto px-4 text-center">
      <p>© 2023 Pet Paradise. All rights reserved.</p>
    </div>
  </footer>

<!-- Your footer here -->

</body>
</html>

