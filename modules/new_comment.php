<?php
require 'db_connect.php';
$comment = mysqli_real_escape_string($conn, $_POST['comment']);
$postid = $_POST['postid'];

if (!isset($_SESSION['user_id'])) echo "notreg";
    else if(mysqli_query($conn, "INSERT INTO comment(content, user_id, post_id, time) VALUES('$comment', '".$_SESSION['user_id']."', '$postid', NOW())")) {
        mysqli_query($conn, "UPDATE post SET comment_count = comment_count + 1 WHERE post_id = '$postid'") or die("database error:". mysqli_error($conn));
        echo '1';
    }
?>