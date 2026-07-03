<?php
// backend/signup.php
include "db.php";

$name  = $_POST['name'];
$email = $_POST['email'];
$pass  = $_POST['password'];

$email = mysqli_real_escape_string($conn, $email);
$name  = mysqli_real_escape_string($conn, $name);
$pass  = mysqli_real_escape_string($conn, $pass);

$check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
if(mysqli_num_rows($check) > 0){
    echo "<script>alert('Email already exists'); window.location.href='../frontend/signup.html';</script>";
    exit;
}

$q = mysqli_query($conn, "INSERT INTO users(name,email,password) VALUES('$name','$email','$pass')");

if($q){
    echo "<script>alert('Signup successful. Please login.'); window.location.href='../frontend/login.html';</script>";
} else {
    echo "<script>alert('Error: ".mysqli_error($conn)."'); window.location.href='../frontend/signup.html';</script>";
}
?>
// signup backend updated
