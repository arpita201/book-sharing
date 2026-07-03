<?php
// backend/getMyBooks.php
include "db.php";

header('Content-Type: application/json');

// simple version: sob books show (user-wise na)
$q = mysqli_query($conn, "SELECT * FROM books");
$data = [];

while($row = mysqli_fetch_assoc($q)){
    $data[] = $row;
}

echo json_encode($data);
?>
