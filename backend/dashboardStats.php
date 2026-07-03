<?php
include "db.php";

$books = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM books"))[0];
$pending = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM requests WHERE status='Pending'"))[0];
$approved = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM requests WHERE status='Approved'"))[0];

echo json_encode([
    "books"=>$books,
    "pending"=>$pending,
    "approved"=>$approved
]);
?>