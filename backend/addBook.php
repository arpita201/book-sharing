<?php
include "db.php";

$title  = mysqli_real_escape_string($conn, $_POST['title']);
$author = mysqli_real_escape_string($conn, $_POST['author']);

$imageName = "default-book.jpg";

// Check if image uploaded
if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

    $imageName = time() . "_" . basename($_FILES["image"]["name"]);

    $target = "../images/" . $imageName;

    move_uploaded_file($_FILES["image"]["tmp_name"], $target);
}

// Insert into database
$sql = "INSERT INTO books (title, author, image)
VALUES ('$title','$author','$imageName')";

if(mysqli_query($conn,$sql)){
    echo "<script>
    alert('Book Added Successfully!');
    window.location='../frontend/add-book.html';
    </script>";
}else{
    echo mysqli_error($conn);
}
?>