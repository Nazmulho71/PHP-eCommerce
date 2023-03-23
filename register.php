<?php
require 'autoload.php';

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $rc = new RegisterController($username, $email, $password);
  $rc->register_user();
}

?>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
  <label for="">Enter your name</label>
  <input type="text" name="username" value="<?php echo $username ?? '' ?>">
  <p><?php echo $rc->username_err ?? '' ?></p>

  <label for="">Enter your email</label>
  <input type="email" name="email" value="<?php echo $email ?? '' ?>">
  <p><?php echo $rc->email_err ?? '' ?></p>

  <label for="">Enter password</label>
  <input type="password" name="password">
  <p><?php echo $rc->pass_err ?? '' ?></p>

  <button type="submit" name="submit">Register</button>
</form>