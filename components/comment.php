<div class="comment">
            <hr class="line">
            <div class="comment-main">
            <a class="author-info" href="profile.php?id=<?php echo $comment['user_id'] ?>">
            <img class="profile-photo-small" src="images/<?php echo $comment['photo']?>">
            <div class="nametime">
            <div class="comment-author"><?php echo $comment['username']?></div>
            <div class="comment-time"><?php echo timeAgo($comment['time']);?></div>
        </div>
        </a>
            <div class="comment-content"><?php echo $comment['content']?></div>
        </div>
            <div class="comment-like">
                <?php if(isset($_SESSION['user_id'])) {
                    if(check_comment_like($_SESSION['user_id'], $comment['comment_id'])) {
                        ?>
                        <img class="unlike" id="<?php echo $comment['comment_id']?>" src="images/heart-liked.svg"></img>
                        <?php
                    }
                    
                    else {
                    ?>
                    <img class="like" id="<?php echo $comment['comment_id']?>" src="images/heart.svg"></img>
                    <?php
                    }
                }
                else {
                ?>
                    <img class="like" id="<?php echo $comment['comment_id']?>" src="images/heart.svg"></img>
                    <?php
                    }
                ?>
            
            <div class="like_count"><?php echo $comment['likes']?></div>
        </div>
        <?php if(isset($_SESSION['user_id'])) if($_SESSION['user_id'] == $comment['user_id']) echo '<i class="fas fa-times delete" value="comment" id="'.$comment['comment_id'].'"></i>'; ?>

        </div>