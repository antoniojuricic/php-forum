<head>
<?php
require('components/header.php');
$profile = mysqli_fetch_assoc(getProfile($_GET['id']));
if ($profile == 0) {
    header("location: 404.php");
    die();
}
?>
<input style="display:none" id="current_user_id" value="<?php echo $_SESSION['user_id'] ?>"></input>
<input style="display:none" id="profile_id" value="<?php echo $_GET['id'] ?>"></input>

</head>
<body>

<input type="file" id="imgupload" style="display:none"/> 
    <?php include 'components/navbar.php';?>
    <div class="main">
    <div style="width:15%; position:relative; float:left;"></div>
    <div class="feed">
    <div class="back" onclick="history.go(-1);"><i class="fas fa-chevron-left"></i>  natrag</div>

    <div class="profile-header-ext">
        <div class="profile-content">
            <div class="photo-shadow"></div>
        <img class="profile-photo-main" id="profile-photo" title="Kliknite za promjenu fotografije" src="images/<?php echo $profile['photo'];?>">
        <div class="header-username">
          <span>  <?php echo $profile['username']?></span>
</div>

<div class="profile-stats">
<div class="stat">
Objave:  <?php echo getPostStat($_GET['id']);?>
</div>
<div class="stat">
Komentari:  <?php echo getCommentStat($_GET['id']);?>
</div>
<div class="stat">
Sviđanja:  <?php echo getLikeStat($_GET['id']); ?>
</div>
</div>
</div>
        <div class="profile-header">
        </div>
    </div>
    <div class="feed-header">
        Objave
    </div>
   <?php
   $posts = getUserPosts($_GET['id']);
   if (mysqli_num_rows($posts)) while ($post = mysqli_fetch_assoc($posts)) { 
    include 'components/post.php';
} 
else {
    echo '<div class="empty-error">Ovaj korisnik nema objava.</div>';
}?>
    </div>

    </div>
</body>