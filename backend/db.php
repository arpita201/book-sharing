<?php
$conn = mysqli_connect("localhost", "root", "", "bookshare_db");

if(!$conn){
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>