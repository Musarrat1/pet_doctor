<?php
// book_service.php

// Basic sanitization + validation example
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service_name = trim($_POST['service_name'] ?? '');
    $customer_name = trim($_POST['customer_name'] ?? '');
    $customer_email = trim($_POST['customer_email'] ?? '');
    $customer_phone = trim($_POST['customer_phone'] ?? '');
    $booking_date = trim($_POST['booking_date'] ?? '');

    if (!$service_name || !$customer_name || !$customer_email || !$booking_date) {
        die("Please fill in all required fields.");
    }

    if (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Database connection (update with your credentials)
    $host = 'localhost';
    $db = 'petplace';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        $stmt = $pdo->prepare('INSERT INTO service_bookings (service_name, customer_name, customer_email, customer_phone, booking_date) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$service_name, $customer_name, $customer_email, $customer_phone, $booking_date]);

        echo "<script>alert('Booking successful! We will contact you soon.'); window.location.href='services.php';</script>";
        exit;

    } catch (PDOException $e) {
        // Log error in real app instead of die
        die("Database error: " . $e->getMessage());
    }

} else {
    // Redirect if accessed directly
    header('Location: services.php');
    exit;
}
?>
