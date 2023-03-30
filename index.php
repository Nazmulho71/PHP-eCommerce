<?php
session_start();
require 'autoload.php';
?>

<?php if (!isset($_SESSION['username'])) : ?>
  <a href="register.php">Register</a>
  <a href="login.php">Login</a>
<?php else : ?>
  <a href="includes/logout.php">Logout</a>
<?php endif ?>

<p>Welcome, <?php echo $_SESSION['username'] ?? 'Unknown' ?></p>

<a href="create_product.php">Add new product</a>
<br>
<br>

<?php
$pdo = new ProductModel;
$products = $pdo->view();

foreach ($products as $product) :
?>
  <img src="<?php echo $product['image'] ?>" alt="Image" height="50px">
  <h1><?php echo $product['title'] ?></h1>
  <p><?php echo $product['description'] ?></p>

  <button><a href="update_product.php?id=<?php echo $product['id'] ?>">Update</a></button>
  <button><a href="includes/delete_product.php?id=<?php echo $product['id'] ?>">Delete</a></button>
  <br>
  <br>
<?php endforeach ?>