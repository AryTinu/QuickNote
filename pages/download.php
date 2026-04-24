<?php
session_start();
include("../config/db.php");

$id = intval($_GET['id']);

$res = $conn->query("SELECT * FROM notes WHERE id=$id");

if ($res->num_rows == 0) die("Not found");

$file = $res->fetch_assoc();

$path = "../uploads/" . $file['file_path'];

if (!file_exists($path)) die("File missing");

$conn->query("UPDATE notes SET downloads = downloads + 1 WHERE id=$id");

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"".$file['file_path']."\"");
readfile($path);
exit;
?>