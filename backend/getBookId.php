<?php
include "db.php";

$name = mysqli_real_escape_string($conn, $_GET['name']);

$q = mysqli_query($conn, "SELECT id FROM books WHERE title='$name' LIMIT 1");

if (mysqli_num_rows($q) == 1) {
    $data = mysqli_fetch_assoc($q);
    echo $data['id'];
} else {
    echo "0";
}
?>