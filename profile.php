<?php
include 'includes/header.php';

if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $passmatch = $_POST['passmatch'];
  $profile = new ProfileController($username, $email, $password, $passmatch);
  $profile->update_profile();
}
?>

<div class="p-5">
  <h1 class="mb-4">Update your <span class="text-danger bg-gradient">Profile</span></h1>

  <form action="" method="post">
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" class="form-control <?php echo @$profile->username_err ? 'is-invalid' : '' ?>" name="username" value="<?php echo $username ?? $_SESSION['username'] ?>" aria-describedby="username">
      <div class="invalid-feedback"><?php echo $profile->username_err ?? '' ?></div>
    </div>

    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" class="form-control <?php echo @$profile->email_err ? 'is-invalid' : '' ?>" name="email" value="<?php echo $email ?? $_SESSION['email'] ?>" aria-describedby="email">
      <div class="invalid-feedback"><?php echo $profile->email_err ?? '' ?></div>
    </div>

    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" class="form-control <?php echo @$profile->pass_err ? 'is-invalid' : '' ?>" name="password" aria-describedby="password">
    </div>

    <div class="mb-3">
      <label class="form-label">Re-Enter Password</label>
      <input type="password" class="form-control <?php echo @$profile->pass_err ? 'is-invalid' : '' ?>" name="passmatch" aria-describedby="passmatch">
      <div class="invalid-feedback"><?php echo $profile->pass_err ?? '' ?></div>
    </div>

    <button type="submit" class="btn btn-danger bg-gradient" name="submit">Update</button>
  </form>
</div>

<?php include 'includes/footer.php' ?>