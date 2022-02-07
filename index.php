<head>
<?php
require('components/header.php');		
?>
</head>
<body>
    <?php include 'components/navbar.php';?>
    <div class="main">
      <?php include 'components/sidebar.php';?>
        <div class="feed">
            <div class="feed-header">
            <div class="sort-menu">
        <?php if(isset($_GET["sort"])){
                $sort = $_GET["sort"];
            } else {
                $sort = "newest";
            };
            if (isset($_GET['category'])) {
                $category_info = mysqli_fetch_assoc(getCategories($_GET['category']));
                $category = "&category=".$_GET['category'];
                echo '<div class="category-title-header">KATEGORIJA</div><div class="category-title">'.$category_info['category_name'].'</div>';
            } else {
                $category = "";
            };
            ?>
        <a href="?sort=newest<?php echo $category ?>" class="<?php if($sort == "newest") echo "current" ?>">Najnovije</option>
        <a href="?sort=most_liked<?php echo $category ?>" class="<?php if($sort == "most_liked") echo "current" ?>">Najviše sviđanja</option>
        <a href="?sort=popular<?php echo $category ?>" class="<?php if($sort == "popular") echo "current" ?>">Najviše komentara</option>
        </div>
   
</div>
            <?php
            if (isset($_GET['category'])) {
                $category = $_GET['category'];
            } else $category = 'all';
            if ($posts = getAllPosts($sort, $category)) {
                while ($post = mysqli_fetch_assoc($posts)) { 
                    include 'components/post.php';
                }
            } 
            else {
                echo '<div class="error-msg">Nema tema za prikaz. Započni novu!</div>';
            }
            ?>
        </div>
</div>
</body>
