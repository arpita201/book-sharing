<?php
session_start();
include "db.php";

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["name" => "Not logged in", "email" => "Not logged in"]);
    exit;
}

$user_id = $_SESSION['user_id'];

$q = mysqli_query($conn, "SELECT name, email FROM users WHERE id='$user_id'");
$data = mysqli_fetch_assoc($q);

echo json_encode($data);
?>