<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm = $_POST["confirm_password"];

    // Validate username
    if (!preg_match("/^[A-Za-z0-9_ ]{3,30}$/", $username)) {
        die("Username must be 3-30 characters and contain only letters, numbers, spaces, or underscores.");
    }

    // Validate email
    if (!preg_match("/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/", $email)) {
        die("Invalid email format.");
    }

    // Validate password
    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/", $password)) {
        die("Password must be at least 6 characters and contain at least one letter and one number.");
    }

    // Confirm password match
    if ($password !== $confirm) {
        die("Passwords do not match.");
    }

    // Hash and insert
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed);

    if ($stmt->execute()) {
        $_SESSION["user_id"] = $stmt->insert_id;
        $_SESSION["username"] = $username;
        header("Location: store.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
