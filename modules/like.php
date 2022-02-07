<?php
require 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    echo 0;
    die();
}

if ($_POST['type']) {
    $post_id = $_POST["post_id"];
    $user_id = $_SESSION['user_id'];

    if ($_POST['liked'] == 0) {
        mysqli_query($conn, "INSERT INTO post_like (user_id, post_id) VALUES ($user_id, $post_id)");
        mysqli_query($conn, "UPDATE post SET likes = likes + 1 WHERE post_id = $post_id");
        $result = mysqli_query($conn, "SELECT * FROM post WHERE post_id=$post_id");
        $row = mysqli_fetch_array($result);
    }
    else {
        mysqli_query($conn, "DELETE FROM post_like WHERE post_id =$post_id AND user_id =$user_id");
        mysqli_query($conn, "UPDATE post SET likes = likes - 1 WHERE post_id = '".$post_id."'");
        $result = mysqli_query($conn, "SELECT * FROM post WHERE post_id=$post_id");
        $row = mysqli_fetch_array($result);
    }

} else {
$comment_id = $_POST["comment_id"];
$user_id = $_SESSION['user_id'];
if ($_POST['liked'] == 0) {
    mysqli_query($conn, "INSERT INTO comment_like (user_id, comment_id) VALUES ($user_id, $comment_id)");
    mysqli_query($conn, "UPDATE comment SET likes = likes + 1 WHERE comment_id = '".$comment_id."'");
    $result = mysqli_query($conn, "SELECT * FROM comment WHERE comment_id=$comment_id");
    $row = mysqli_fetch_array($result);
}
else {
    mysqli_query($conn, "DELETE FROM comment_like WHERE comment_id =$comment_id AND user_id =$user_id");
    mysqli_query($conn, "UPDATE comment SET likes = likes - 1 WHERE comment_id = '".$comment_id."'");
    $result = mysqli_query($conn, "SELECT * FROM comment WHERE comment_id=$comment_id");
    $row = mysqli_fetch_array($result);
}
}
echo $row['likes'];
?>