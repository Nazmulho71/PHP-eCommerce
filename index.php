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

<a href="create_product.php">Add new product</a><br><br>

<form action="" method="GET">
  <input type="text" name="search" placeholder="Search products..." value="<?php echo $_GET['search'] ?? '' ?>">
  <button type="submit">Search</button>
</form>

<form action="" method="POST">
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
$search = '';
if (isset($_GET['search'])) {
  $search = $_GET['search'];
}
if (isset($_POST["filter"])) {
  $filter = $_POST["filter"];
}

$products = $prodmod->view($filter, $search);

if (empty($products)) : ?>
  <p>No products found.</p>
  <?php
else :
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
<?php endforeach;
endif ?>