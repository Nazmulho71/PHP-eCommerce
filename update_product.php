<?php
require 'autoload.php';

$id = $_GET['id'];
if (!isset($id)) {
  header('Location: index.php');
}

$pdo = new ProductModel;
$products = $pdo->view();

foreach ($products as $product) {
  if ($product['id'] == $_GET['id'])
    $update_product = $product;
}

if (isset($_POST['submit'])) {
  $image = $_POST['image'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $product = new ProductController($image, $title, $description, $id);
  $product->update_product();
}

?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?php echo $_GET['id'] ?>" method="post">
  <label for="">Image url</label>
  <input type="text" name="image" value="<?php echo $update_product['image'] ?? $image ?>">
  <p><?php echo $product->image_err ?? '' ?></p>
  <label for="">Title</label>
  <input type="text" name="title" value="<?php echo $update_product['title'] ?? $title ?>">
  <p><?php echo $product->title_err ?? '' ?></p>
  <textarea name="description" id="" cols="30" rows="10" placeholder="Product description..."><?php echo $update_product['description'] ?? $description ?></textarea>
  <p><?php echo $product->description_err ?? '' ?></p>

  <button type="submit" name="submit">Update</button>
</form>