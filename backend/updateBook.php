<?php

include "db.php";

$id=$_POST['id'];

$title=mysqli_real_escape_string($conn,$_POST['title']);

$author=mysqli_real_escape_string($conn,$_POST['author']);

mysqli_query($conn,

"UPDATE books
SET
title='$title',
author='$author'
WHERE id='$id'");

header("Location: ../frontend/manage-books.html");

?>