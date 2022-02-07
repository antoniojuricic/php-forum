<link rel="stylesheet" href="style.css">

<div class="navbar">
    <a class="logotxt" href="index.php"><!--<img src="logo.svg">--> Forumanija</a>
        <div class="search">
    <input class="searchbar" id="search" type="text" placeholder="Pretraži teme..."></input>
</div>
<?php 
if(empty($_SESSION['username'])) {?>
<div class="buttons">
<button class="login_btn" id="login_btn">Prijava</button>
<a class="registration_btn" id="registration_btn">Registracija</a>
</div>
<?php } 
else {
    ?>
    <div class="user-nav">
    <a class="primary" href="profile.php?id=<?php echo $_SESSION['user_id'] ?>"><?php echo $_SESSION['username']?></a>
        <a class="logout-btn" href="logout.php" id="logout">Odjava</a>
</div>
    <?php
}
?>

</div>