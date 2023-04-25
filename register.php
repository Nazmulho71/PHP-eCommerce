<?php
include 'includes/header.php';

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $rc = new RegisterController($username, $email, $password);
  $rc->register_user();
}
?>

<div class="p-5">
  <h1 class="mb-4">Create a new Account to hunt <span class="text-danger bg-gradient">hottest</span> Pizza's!</h1>

  <form action="" method="post">
    <div class="mb-3">
      <label class="form-label">Enter your name</label>
      <input type="text" class="form-control <?php echo @$rc->username_err ? 'is-invalid' : '' ?>" name="username" value="<?php echo $username ?? '' ?>" aria-describedby="username">
      <div class="invalid-feedback"><?php echo $rc->username_err ?? '' ?></div>
    </div>

    <div class="mb-3">
      <label class="form-label">Enter your email</label>
      <input type="email" class="form-control <?php echo @$rc->email_err ? 'is-invalid' : '' ?>" name="email" value="<?php echo $email ?? '' ?>" aria-describedby="email">
      <div class="invalid-feedback"><?php echo $rc->email_err ?? '' ?></div>
    </div>

    <div class="mb-3">
      <label class="form-label">Enter password</label>
      <input type="password" class="form-control <?php echo @$rc->pass_err ? 'is-invalid' : '' ?>" name="password" value="<?php echo $password ?? '' ?>" aria-describedby="password">
      <div class="invalid-feedback"><?php echo $rc->pass_err ?? '' ?></div>
    </div>

    <p>Already have an account? <a class="text-danger" href="login.php">Login</a></p>
    <button type="submit" class="btn btn-danger bg-gradient" name="submit">Register</button>
  </form>
</diV>

<?php include 'includes/footer.php' ?>