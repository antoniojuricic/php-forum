<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forum";
$conn = mysqli_connect($servername, $username, $password, $dbname) OR 
die("Greška pri spajanju s bazom podataka: " . mysqli_connect_error());
session_start();
?>