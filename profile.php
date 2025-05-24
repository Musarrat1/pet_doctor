<?php
session_start();
include 'db.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION["user_id"]; // ✅ Must come before SQL queries

// Fetch purchase data
$purchases = [];
$total_items = 0;

$stmt = $conn->prepare("
    SELECT p.name, SUM(pr.quantity) AS total_quantity
    FROM purchases pr
    JOIN products p ON pr.product_id = p.id
    WHERE pr.user_id = ?
    GROUP BY pr.product_id
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res = $stmt->get_result();

while ($row = $res->fetch_assoc()) {
    $purchases[] = $row;
    $total_items += $row['total_quantity'];
}

// Fetch user info
$stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $username = htmlspecialchars($user["username"]);
    $email = htmlspecialchars($user["email"]);
} else {
    echo "User not found.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Profile | Pet Place</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #f9f9fb, #FEF3E2);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding-top: 60px;
    }
    .profile-container {
      background: #fff;
      border-radius: 20px;
      padding: 2rem;
      box-shadow: 0 15px 50px rgb(248, 231, 204);
      max-width: 500px;
      width: 100%;
      position: relative;
    }
    .profile-header {
      text-align: center;
      margin-bottom: 2rem;
    }
    .profile-header h2 {
      font-size: 1.8rem;
      color: #333;
    }
    .profile-header p {
      color: #FFB22C;
      font-size: 0.95rem;
      margin-top: 0.2rem;
    }
    .purchase-summary {
      background: #FEF3E2;
      border-radius: 12px;
      padding: 1.2rem;
      margin-top: 1rem;
    }
    .purchase-summary h3 {
      margin-bottom: 1rem;
      font-size: 1.1rem;
      color: #FFB22C;
    }
    .purchase-summary ul {
      padding-left: 1.2rem;
      color: #333;
      font-size: 0.95rem;
    }
    .purchase-summary p {
      margin-top: 1rem;
      font-weight: 600;
      color: #444;
    }
    .logout-btn {
      margin-top: 2rem;
      background: #ff6b6b;
      color: #fff;
      border: none;
      padding: 12px 24px;
      border-radius: 10px;
      cursor: pointer;
      width: 100%;
      font-weight: bold;
      font-size: 1rem;
    }
    .logout-btn:hover {
      background: #e85c5c;
    }
    .back-arrow {
     display: inline-flex;
      top: -40px;
      left: 0;
      font-size: 1rem;
      color: #FA812F;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 6px;
      font-weight: 500;
      transition: 0.3s;
    }
    .back-arrow:hover {
     
      color: #e26b1e;
    }
  </style>
</head>
<body>

  <div class="profile-container">
  

    <div class="profile-header">
        <a href="store.php" class="back-arrow"><i class="ri-arrow-left-line"></i></a>
      <h2>Hi, <?= $username; ?>!</h2>
      <p><?= $email; ?></p>
    </div>

    <?php if (!empty($purchases)): ?>
      <div class="purchase-summary">
        <h3>Your Purchase Summary:</h3>
        <ul>
          <?php foreach ($purchases as $item): ?>
            <li><?= htmlspecialchars($item['name']) ?> — <?= $item['total_quantity'] ?> purchased</li>
          <?php endforeach; ?>
        </ul>
        <p>Total items bought: <?= $total_items ?></p>
      </div>
    <?php endif; ?>

    <form method="post" action="logout.php">
      <button type="submit" class="logout-btn">Logout</button>
    </form>
  </div>

</body>

