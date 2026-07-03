<?php
include "db.php";

header('Content-Type: application/json');

$q = mysqli_query($conn, "
    SELECT r.id, r.status, b.title AS book
    FROM requests r
    JOIN books b ON r.book_id = b.id
");

$data = [];

while($row = mysqli_fetch_assoc($q)){
    $data[] = $row;
}

echo json_encode($data);
?>