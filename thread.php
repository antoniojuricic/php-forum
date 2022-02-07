<head>
<?php
require('components/header.php');				
?>

</head>
<body>
<?php 
$id = intval($_GET['id']);
$post = mysqli_fetch_assoc(getPost($id));
if ($post == 0) {
    header("location: 404.php");
    die();
}
include 'components/navbar.php';
	?>
    <div class="main">
      <?php include 'components/sidebar.php';?>
    <div class="feed">
    <div class="back" onclick="history.go(-1);"><i class="fas fa-chevron-left"></i>  natrag</div>

        <?php 
        
        ?>
        <div class="thread">
        <div class="card_category"><?php echo $post['category_name']; ?></div>
            <div class="thread-title">
                <?php echo $post['title'];?>
            </div>
            <a class="author-info" href="profile.php?id=<?php echo $post['user_id'] ?>">
            <img class="profile-photo-small" src="images/<?php echo $post['photo'];?>">
            <div class="nametime">
            <div class="comment-author">
                <?php echo $post['username'];?>
            </div>
            <div class="comment-time"><?php echo timeAgo($post['time']);?></div>
            </div>
            </a>
            <div class="comment-content thread-subtitle">
                <?php echo $post['subtitle'];?>
            </div>
        <?php
        if($comments = getAllComments($id)) while ($comment = mysqli_fetch_assoc($comments)) { 
            include 'components/comment.php';
        }
        if (!$post['comment_count']) {
            echo '            <hr class="line">
            <div class="empty-error">Nema komentara. Budi prvi!</div>';
        }
        ?>
        <div class="reply">
            <textarea class="reply-box" placeholder="Ostavite komentar" id="reply-box" name="reply-box" ></textarea>
            <div class="reply-btn-main">
            <i class="far fa-paper-plane reply-btn" id="submit-comment" name="submit-comment"></i>
    </div>
            <input type="hidden" name="postid" id="postid" value="<?php echo $id; ?>">
        </div>
