<?php
include "db.php";

$book_name = mysqli_real_escape_string($conn, $_POST['book_name']);
$review = mysqli_real_escape_string($conn, $_POST['review']);

if (empty($book_name) || empty($review)) {
    echo "error";
    exit;
}

$q = mysqli_query($conn,
    "INSERT INTO reviews (book_name, review, created_at)
     VALUES ('$book_name', '$review', NOW())"
);

echo $q ? "success" : "error";
?>