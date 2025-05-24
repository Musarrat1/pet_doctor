<?php
include 'db.php';

if (!isset($_GET['id'])) {
    die("Product ID not specified.");
}

$id = intval($_GET['id']);

$sql = "DELETE FROM products WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    header("Location: add_product.php");
} else {
    echo "❌ Error deleting product: " . $conn->error;
}
?>
