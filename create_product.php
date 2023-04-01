<?php
session_start();
require 'autoload.php';

if (isset($_POST['submit'])) {
  $image = $_POST['image'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $user_id = $_SESSION['id'];
  $product = new ProductController($image, $title, $description, '', $user_id);
  $product->create_product();
}

?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
  <label for="">Image url</label>
  <input type="text" name="image" value="<?php echo $image ?? '' ?>">
  <p><?php echo $product->image_err ?? '' ?></p>
  <label for="">Title</label>
  <input type="text" name="title" value="<?php echo $title ?? '' ?>">
  <p><?php echo $product->title_err ?? '' ?></p>
  <textarea name="description" id="" cols="30" rows="10" placeholder="Product description..."><?php echo $description ?? '' ?></textarea>
  <p><?php echo $product->description_err ?? '' ?></p>

  <button type="submit" name="submit">Publish</button>
</form>