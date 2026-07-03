<?php
// backend/borrow.php
include "db.php";

$id = (int)$_GET['id'];

$q = mysqli_query($conn, "INSERT INTO requests(book_id, status) VALUES($id, 'Pending')");

if($q){
    echo "<script>alert('Borrow request sent'); window.location.href='../frontend/borrow.html';</script>";
} else {
    echo "<script>alert('Error: ".mysqli_error($conn)."'); window.location.href='../frontend/borrow.html';</script>";
}
?>
// borrow backend updated
