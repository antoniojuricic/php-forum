<div class="left-sidebar">
        <a class="new_topic_btn" id="new_btn" >Započnite novu temu</a>
            <div class="menu">
              <div class="categories-title">Kategorije</div>
                <ul class="menu_list">
                    <?php
     $categories = getCategories();
    while($row = mysqli_fetch_assoc($categories)) {
      ?>
      <li><a href="index.php?category=<?php echo $row['slug']?>">
      <?php echo $row['category_name']?> (<?php echo $row['post_number'];?>)</a></li>
      <?php
    }
    ?>
    </ul>
                
            </div>
        </div>