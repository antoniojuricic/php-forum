<?php
require 'db_connect.php';

if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['category'])) {

$title = mysqli_real_escape_string($conn, $_POST['title']);
$content = mysqli_real_escape_string($conn, $_POST['content']);
$category = $_POST['category'];
$user_id = $_SESSION['user_id'];

mysqli_query($conn, 
"INSERT INTO 
post(user_id, title, subtitle, time, category_id)
 VALUES 
('$user_id','$title','$content', NOW(), '$category')") or die("database error:". mysqli_error($conn));
$thread_id = mysqli_insert_id($conn);
mysqli_query($conn, "UPDATE category SET post_number = post_number + 1 WHERE category_id = '$category'") or die("database error:". mysqli_error($conn));

echo $thread_id;
}
else {
    echo 0;
}
?>