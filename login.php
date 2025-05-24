<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Validate email format using regex
    if (!preg_match("/^[\w\-\.]+@([\w-]+\.)+[\w-]{2,4}$/", $email)) {
        echo "Invalid email format.";
        exit();
    }

    // Optional: Validate password (e.g., min 6 characters, at least 1 letter and 1 number)
    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/", $password)) {
        echo "Password must be at least 6 characters long and contain at least one letter and one number.";
        exit();
    }

    // Proceed with login
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            header("Location: store.php");
            exit();
        } else {
            echo "Invalid credentials.";
        }
    } else {
        echo "No account found.";
    }
}
?>
