<?php
include 'db.php';

$sql = "SELECT * FROM products ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo '<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">';
  while($row = $result->fetch_assoc()) {
    echo '
      <div class="product-card bg-white rounded-xl shadow-md overflow-hidden transition duration-300 hover:shadow-lg">
        <div class="product-image relative overflow-hidden bg-petbrown-100 h-48 flex items-center justify-center">
          <img src="'.htmlspecialchars($row["image"]).'" alt="'.htmlspecialchars($row["name"]).'" class="w-full h-full object-cover transition duration-300"/>
        </div>
        <div class="p-4">
          <div class="flex justify-between items-start mb-1">
            <h3 class="font-semibold text-lg">'.htmlspecialchars($row["name"]).'</h3>
            <span class="text-petgreen-600 font-bold">$'.number_format($row["price"], 2).'</span>
          </div>
          <p class="text-gray-500 text-sm mb-3">'.htmlspecialchars($row["description"]).'</p>
          <button class="bg-purple-400 text-white hover:bg-purple-300 transition p-2 rounded-full" aria-label="Add '.htmlspecialchars($row["name"]).' to cart">
            <i class="fas fa-shopping-cart"></i>
          </button>
        </div>
      </div>
    ';
  }
  echo '</div>';
} else {
  echo "No products found.";
}

$conn->close();
?>
