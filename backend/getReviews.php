<?php
include "db.php";

header("Content-Type: application/json");

$q = mysqli_query($conn,
    "SELECT book_name, review, created_at
     FROM reviews
     ORDER BY id DESC"
);

$data = [];

while($row = mysqli_fetch_assoc($q)){
    $data[] = $row;
}

echo json_encode($data);
?>