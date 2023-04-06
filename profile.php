<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}

require 'autoload.php';

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $passmatch = $_POST['passmatch'];
  $profile = new ProfileController($username, $email, $password, $passmatch);
  $profile->update_profile();
}

?>

<form action="" method="post">
  <label for="">Name</label>
  <input type="text" name="username" value="<?php echo $username ?? $_SESSION['username'] ?>">
  <p><?php echo $profile->username_err ?? '' ?></p>

  <label for="">Email</label>
  <input type="email" name="email" value="<?php echo $email ?? $_SESSION['email'] ?>">
  <p><?php echo $profile->email_err ?? '' ?></p>

  <label for="">Password</label>
  <input type="password" name="password"><br><br>

  <label for="">Re-enter Password</label>
  <input type="password" name="passmatch">
  <p><?php echo $profile->pass_err ?? '' ?></p>

  <button type="submit" name="submit">Update</button>
</form>