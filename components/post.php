<div class="card">
            <a class="post-link" href="thread.php?id=<?php echo $post['post_id']?>"></a>
            <div class="card_main">
                <div class="card_category"><a class="ontop" href="index.php?category=<?php echo $post['category_id']?>"><?php echo $post['category_name']; ?></a></div>
                <div class="card_title"><?php echo $post['title']; ?></div>
                <div class="card_subtitle"><?php echo $post['subtitle']; ?></div>
                <div class="card_bottom">
                    <div class="card_info">
                        <div class="time_author">
                        <a href="profile.php?id=<?php echo $post['user_id'] ?>"> 
                        <img class="profile-photo-smaller" src="<?php echo "images/" . $post['photo'];?>">
                            <?php echo $post['username']?> </a><div class="dot">•</div><?php echo timeAgo($post['time']); ?>
                            
                        </div>
                        
                        <div class="card_comments"><?php echo $comment_number = getCommentCount($post['post_id']); echo ($comment_number == 1) ? " komentar" : " komentara"; ?></div>
                    </div>
                </div>
            </div>
            <div class="card_like">
            <?php 
            if(isset($_SESSION['user_id'])) {
                    if(check_post_like($_SESSION['user_id'], $post['post_id'])) {
                        ?>
                        <img class="post_unlike" id="<?php echo $post['post_id']?>" src="images/heart-liked.svg"></img>
                        <?php
                    }
                    
                    else {
                    ?>
                    <img class="post_like" id="<?php echo $post['post_id']?>" src="images/heart.svg"></img>
                    <?php
                    }
                }
                else {
                ?>
                    <img class="post_like" id="<?php echo $post['post_id']?>" src="images/heart.svg"></img>
                    <?php
                    }
                ?>
            <div class="like_count" id="<?php $post['post_id']?>"><?php echo $post['likes']; ?></div>
            </div>
            <?php if(isset($_SESSION['user_id'])) if($_SESSION['user_id'] == $post['user_id']) echo '<i class="fas fa-times delete" value="post" id="'.$post['post_id'].'"></i>'; ?>
        </div>