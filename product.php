<?php
require 'autoload.php';

$id = $_GET['id'];
$prodmod = new ProductModel;
$product = $prodmod->view_single($id);
?>

<a href="index.php">Go back</a><br>
<img src="<?php echo $product['image'] ?>" alt="" height="50px">
<h1><?php echo $product['title'] ?></h1>
<b><?php echo $product['price'] ?></b>
<p><?php echo $product['description'] ?></p>
<button>Add to cart</button>
<button>Buy now</button>

<h3>Comments</h3>
<hr>

<b>Abdaal - 3 hours ago</b>
<p>Good product!</p>