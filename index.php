<?php session_start() ?>

<?php if (!isset($_SESSION['username'])) : ?>
  <a href="register.php">Register</a>
  <a href="login.php">Login</a>
<?php else : ?>
  <a href="includes/logout.php">Logout</a>
<?php endif ?>

<p>Welcome, <?php echo $_SESSION['username'] ?? 'Unknown' ?></p>