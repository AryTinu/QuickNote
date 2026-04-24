<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['user_id'])){
    die("Unauthorized");
}

$user_id = $_SESSION['user_id'];
$id = (int)$_GET['id'];

// ✅ CHECK OWNERSHIP + GET FILE
$res = $conn->query("SELECT * FROM notes WHERE id=$id AND user_id=$user_id");

if(!$res || $res->num_rows == 0){
    die("Access denied");
}

$note = $res->fetch_assoc();

// 🔥 DELETE FILE FROM SERVER
$filePath = "../uploads/" . $note['file_path'];

if(file_exists($filePath)){
    unlink($filePath);
}

// 🔥 DELETE FROM DB
$conn->query("DELETE FROM notes WHERE id=$id");

// REDIRECT
header("Location: profile.php");
exit;
?>