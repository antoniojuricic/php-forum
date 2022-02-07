<?php
require 'db_connect.php';

if (isset($_POST['id']) && isset($_POST['type'])) {
    $id = $_POST['id'];
    $type = $_POST['type'];

    if ($type == "post") {
        $category = mysqli_fetch_assoc(mysqli_query($conn, "SELECT category_id FROM post WHERE post_id='$id'"));
        $category_id = $category['category_id'];

        mysqli_query($conn, "DELETE comment, comment_like FROM comment INNER JOIN comment_like ON comment.comment_id=comment_like.comment_id WHERE post_id='$id'")
        or die("Greška s bazom podataka:". mysqli_error($conn));
        mysqli_query($conn, "DELETE post, post_like FROM post LEFT JOIN post_like ON post_like.post_id=post.post_id WHERE post.post_id='$id'")
        or die("Greška s bazom podataka:". mysqli_error($conn));
        mysqli_query($conn, "UPDATE category SET post_number=post_number-1 WHERE category_id='$category_id'")
        or die("Greška s bazom podataka:". mysqli_error($conn));
    }

    else if ($type == "comment") {
        $post = mysqli_fetch_assoc(mysqli_query($conn, "SELECT post_id FROM comment WHERE comment_id='$id'"));
        $post_id = $post['post_id'];

        mysqli_query($conn, "DELETE FROM comment_like WHERE comment_id='$id'") or die("Greška s bazom podataka:". mysqli_error($conn));
        mysqli_query($conn, "DELETE FROM comment WHERE comment_id='$id'") or die("Greška s bazom podataka:". mysqli_error($conn));
        mysqli_query($conn, "UPDATE post SET comment_count=comment_count-1 WHERE post_id='$post_id'") or die("Greška s bazom podataka:". mysqli_error($conn));

    }
}
?>