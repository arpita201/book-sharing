<?php
include "db.php";

$id = $_GET['id'];
$status = $_GET['status'];

mysqli_query($conn,
"UPDATE requests SET status='$status' WHERE id='$id'");

header("Location: ../frontend/admin-requests.html");
exit;
?>