<?php
require 'autoload.php';

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $lc = new LoginController($email, $password);
  $lc->login_user();
}

?>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
  <label for="">Enter Email</label>
  <input type="email" name="email" value="<?php echo $email ?? '' ?>">
  <p><?php echo $lc->email_err ?? '' ?></p>
  <label for="">Enter Password</label>
  <input type="password" name="password">
  <p><?php echo $lc->pass_err ?? '' ?></p>
  <button type="submit" name="submit">Login</button>
</form>