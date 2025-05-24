<?php
$host = "localhost";
$user = "root";
$pass = ""; // Change if you have a DB password
$db = "petplace"; // Correct name as created in phpMyAdmin

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
