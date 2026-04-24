<?php
$host = "localhost";
$user = "root";
$password = "Aryan@123";
$database = "notes_platform";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("DB Connection Failed: " . $conn->connect_error);
}

// Optional: set charset
$conn->set_charset("utf8mb4");
?>