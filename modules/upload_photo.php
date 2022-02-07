<?php
require 'db_connect.php';
$id = $_SESSION['user_id'];
if($_FILES['file']['name'] != ''){
    $test = explode('.', $_FILES['file']['name']);
    $extension = end($test);    
    $name = rand(100,999).'.'.$extension;
    $name_formatted = ". $name .";
    $location = "..\\images\\".$name;
    if(move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
    mysqli_query($conn, "UPDATE user SET photo='".$name."' WHERE user_id='".$id."'");
    echo  "1";
    }
}
?>