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

if (isset($_POST['save'])) {
  $edit_id = $_POST['edit_commentid'];
  $comment = $_POST['edit_comment'];
  $commod->update($comment, $edit_id);

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
  <b><?php echo $_SESSION['username'] == $comment['name'] ? 'You' : $comment['name'] ?> - <?php echo $comment['date'] ?></b>
  <?php if (isset($_GET['comment_id']) && $_GET['comment_id'] == $comment['id']) : ?>
    <form action="" method="post">
      <textarea name="edit_comment"><?php echo $comment['comment'] ?></textarea>
      <input type="hidden" name="edit_commentid" value="<?php echo $comment['id'] ?>">
      <button type="submit" name="save">Save</button>
    </form>
  <?php else : ?>
    <p><?php echo $comment['comment'] ?></p>
  <?php endif ?>

  <?php if ($_SESSION['username'] == $comment['name']) : ?>
    <button><a href="product.php?id=<?php echo $product['id'] ?>&comment_id=<?php echo $comment['id'] ?>">Update</a></button>
    <button>
      <a href="includes/delete_comment.php?product_id=<?php echo $product['id'] ?>&comment_id=<?php echo $comment['id'] ?>">Delete</a>
    </button>
  <?php endif ?>
  <br>
  <br>
<?php endforeach ?>