<?php
include "db_connect.php";

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = md5(mysqli_real_escape_string($conn, $_POST['password']));

if ($username != "" && $password != ""){
    $query = "SELECT * FROM user WHERE (username='".$username."' OR email='".$username."') AND password='".$password."'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_id'] = $row['user_id'];
        echo 1;
    } else {
        echo 0;
    }

}
?>