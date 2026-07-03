<?php
session_start();
include "db.php";

$email = $_POST['email'];
$pass  = $_POST['password'];

$email = mysqli_real_escape_string($conn, $email);
$pass  = mysqli_real_escape_string($conn, $pass);

$q = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$pass'");

if(mysqli_num_rows($q) == 1){

    // Fetch user info
    $row = mysqli_fetch_assoc($q);

    // SET SESSION HERE (This was missing!!)
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user_name'] = $row['name'];
    $_SESSION['user_email'] = $row['email'];

    echo "<script>alert('Login Successful'); window.location.href='../frontend/dashboard.html';</script>";

} else {
    echo "<script>alert('Invalid Email or Password'); window.location.href='../frontend/login.html';</script>";
}
?>
// login backend updated
