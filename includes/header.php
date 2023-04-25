<?php
session_start();
require 'autoload.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="https://famousvillagepizza.com/wp-content/uploads/2021/04/favicon.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="styles/style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <title>PHPizza | Hunt your Dream Pizza</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-danger bg-gradient">
    <div class="container-fluid">
      <a class="navbar-brand text-light" href="index.php">PHPizza</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="w-100 d-flex align-items-center justify-content-between">
          <div></div>
          <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') : ?>
            <div class="w-50">
              <form class="d-flex" role="search" action="" method="GET">
                <input class="form-control me-2" type="search" placeholder="Hunt for Your Dream Pizza!" value="<?php echo $_GET['search'] ?? '' ?>" aria-label="Search" name="search">
                <button class="btn btn-dark bg-gradient" type="submit">Search</button>
              </form>
            </div>
          <?php else : ?>
            <div></div>
          <?php endif ?>

          <div>
            <?php if (!isset($_SESSION['username'])) : ?>
              <a class="w-100 me-2" href="login.php"><button class="btn btn-light bg-gradient">Login</button></a>
              <a class="w-100" href="register.php"><button class="btn btn-dark bg-gradient">Register</button></a>
            <?php else : ?>
              <div class="dropdown pe-3">
                <button class="btn btn-light bg-gradient dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <?php echo $_SESSION['username'] ?>
                </button>
                <ul class="dropdown-menu" style="margin-left: -70px;">
                  <li style="margin: 0 15px 10px 15px;"><?php echo $_SESSION['email'] ?></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                  <li><a class="dropdown-item" href="includes/logout.php">Logout</a></li>
                </ul>
              </div>
            <?php endif ?>
          </div>
        </div>
      </div>
    </div>
  </nav>