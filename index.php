<?php
session_start();
require 'autoload.php';

if (isset($_POST['sortby'])) {
  echo $sortby = $_POST['sortby'];
}
?>

<?php if (!isset($_SESSION['username'])) : ?>
  <a href="register.php">Register</a>
  <a href="login.php">Login</a>
<?php else : ?>
  <a href="includes/logout.php">Logout</a>
<?php endif ?>

<p>Welcome, <?php echo $_SESSION['username'] ?? 'Unknown' ?></p>

<a href="create_product.php">Add new product</a><br><br>

<form method="POST" action="">
  Sort by:
  <select name="filter" onchange="this.form.submit()">
    <option value="" default selected disabled>Select</option>
    <option value="newest" <?php echo @$_POST["filter"] == 'newest' ? 'selected' : '' ?>>Newest</option>
    <option value="lowtohigh" <?php echo @$_POST["filter"] == 'lowtohigh' ? 'selected' : '' ?>>Price: Low to High</option>
    <option value="hightolow" <?php echo @$_POST["filter"] == 'hightolow' ? 'selected' : '' ?>>Price: High to Low</option>
  </select>
</form><br><br>

<?php
$prodmod = new ProductModel;

$filter = '';
if (isset($_POST["filter"])) {
  $filter = $_POST["filter"];
}
$products = $prodmod->view($filter);

foreach ($products as $product) :
?>
  <img src="<?php echo $product['image'] ?>" alt="Image" height="50px">
  <b><?php echo @$_SESSION['username'] == $product['username'] ? 'You' : $product['username'] ?></b>
  <h1><a href="product.php?id=<?php echo $product['id'] ?>"><?php echo $product['title'] ?></a></h1>
  <h3>$ <?php echo $product['price'] ?></h3>
  <p><?php echo $product['description'] ?></p>

  <?php if (@$_SESSION['username'] == $product['username']) : ?>
    <button><a href="update_product.php?id=<?php echo $product['id'] ?>">Update</a></button>
    <button><a href="includes/delete_product.php?id=<?php echo $product['id'] ?>">Delete</a></button>
  <?php endif ?>
  <br>
  <br>
<?php endforeach ?>