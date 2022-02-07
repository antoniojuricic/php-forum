<?php
require 'db_connect.php';
$errors = array();

$username = stripslashes($_REQUEST['username']);
$username = mysqli_real_escape_string($conn,$username); 

$email = stripslashes($_REQUEST['email']);
$email = mysqli_real_escape_string($conn,$email);

$password = stripslashes($_REQUEST['password']);
$password = mysqli_real_escape_string($conn,$password);

$trn_date = date("Y-m-d H:i:s");

if (empty($username)) { array_push($errors, "Korisničko ime je obavezno"); }
if (empty($email)) { array_push($errors, "Email je obavezan"); }
if (empty($password)) { array_push($errors, "Lozinka je obavezna"); }

$user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";
$result = mysqli_query($conn, $user_check_query);
$user = mysqli_fetch_assoc($result);

if ($user) {
  if ($user['username'] === $username) {
    array_push($errors, "Korisničko ime je zauzeto");
  }

  if ($user['email'] === $email) {
    array_push($errors, "Postoji račun s navedenim email-om");
  }
}

if (count($errors) == 0) {
    $query = "INSERT into `user` (username, email, password, date, photo)
    VALUES ('$username','$email', '".md5($password)."', '$trn_date','default.jpg')";
    $result = mysqli_query($conn, $query);
    if($result) {
        $_SESSION['user_id'] = $conn->insert_id;
        $_SESSION['username'] = $username;
        echo 1;
    }
}


?>
<?php  if (count($errors) > 0) : ?>
    <div class="error">
        <?php foreach ($errors as $error) : ?>
          <p><?php echo $error ?></p>
        <?php endforeach ?>
    </div>
  <?php  endif ?>