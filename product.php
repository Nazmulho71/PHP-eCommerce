<?php
session_start();
require 'autoload.php';

$id = $_GET['id'];
$username = $_SESSION['username'];

$prodmod = new ProductModel;
$product = $prodmod->view_single($id);

$commod = new CommentModel;
$comments = $commod->view($id);

if (isset($_POST['submit'])) {
  $comment = $_POST['comment'];
  $commod->create($username, $comment, $id);
  header("Location: product.php?id=$id");
}

?>

<a href="index.php">Go back</a><br>
<img src="<?php echo $product['image'] ?>" alt="" height="200px">
<h1><?php echo $product['title'] ?></h1>
<b><?php echo $product['price'] ?></b>
<p><?php echo $product['description'] ?></p>
<button>Add to cart</button>
<button>Buy now</button>

<h3>Comments</h3>
<hr>

<form action="" method="post">
  <textarea name="comment" id="" cols="30" rows="10"></textarea>
  <button type="submit" name="submit">Comment</button><br>
</form>

<?php foreach ($comments as $comment) : ?>
  <b><?php echo $comment['name'] ?> - <?php echo $comment['date'] ?></b>
  <p><?php echo $comment['comment'] ?></p>
  <br>
<?php endforeach ?>