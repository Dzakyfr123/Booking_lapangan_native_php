<?php
include 'db.php';
if (!isset($_SESSION['user_id'])) header("Location: index.php");

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$conn->query("DELETE FROM bookings WHERE id=$id AND user_id=$user_id");
header("Location: dashboard.php");
?>
