<?php
include 'includes/header.php';

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $lc = new LoginController($email, $password);
  $lc->login_user();
}
?>

<div class="p-5">
  <h1 class="mb-4"><span class="text-danger bg-gradient">Login</span> to your Account</h1>

  <form action="" method="post">
    <div class="mb-3">
      <label class="form-label">Enter Email</label>
      <input type="email" class="form-control <?php echo @$lc->email_err ? 'is-invalid' : '' ?>" name="email" value="<?php echo $email ?? '' ?>" aria-describedby="email">
      <div class="invalid-feedback"><?php echo $lc->email_err ?? '' ?></div>
    </div>

    <div class="mb-3">
      <label class="form-label">Enter Password</label>
      <input type="password" class="form-control <?php echo @$lc->pass_err ? 'is-invalid' : '' ?>" name="password" value="<?php echo $password ?? '' ?>" aria-describedby="password">
      <div class="invalid-feedback"><?php echo $lc->pass_err ?? '' ?></div>
    </div>

    <p>Don't have an account? <a class="text-danger" href="register.php">Register Now</a></p>
    <button type="submit" class="btn btn-danger bg-gradient" name="submit">Login</button>
  </form>
</diV>

<?php include 'includes/footer.php' ?>