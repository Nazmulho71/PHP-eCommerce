<?php include 'includes/header.php' ?>

<?php
if (isset($_POST['submit'])) {
  $image = $_POST['image'] ?? '';
  $title = $_POST['title'] ?? '';
  $price = $_POST['price'] ?? '';
  $description = $_POST['description'] ?? '';
  $user_id = $_SESSION['id'];
  $product = new ProductController($image, $title, $price, $description, '', $user_id);
  $product->create_product();
}
?>

<div class="p-5">
  <h1 class="mb-4">Have new <span class="text-danger bg-gradient">Pizza</span> for sell?</h1>

  <form action="" method="post">
    <div class="mb-3">
      <label class="form-label">Image URL (Optional)</label>
      <input type="text" class="form-control" name="image" value="<?php echo $image ?? '' ?>" aria-describedby="image">
    </div>
    <div class="mb-3">
      <label class="form-label">Pizza name</label>
      <input type="text" class="form-control <?php echo @$product->title_err ? 'is-invalid' : '' ?>" name="title" value="<?php echo $title ?? '' ?>" aria-describedby="title">
      <div class="invalid-feedback"><?php echo $product->title_err ?? '' ?></div>
    </div>
    <div class="mb-3">
      <label class="form-label">Price</label>
      <input type="text" class="form-control <?php echo @$product->price_err ? 'is-invalid' : ''; ?>" name="price" value="<?php echo $price ?? '' ?>" aria-describedby="price">
      <div class="invalid-feedback"><?php echo $product->price_err ?? '' ?></div>
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea class="form-control <?php echo @$product->description_err ? 'is-invalid' : ''; ?>" placeholder="Enter details of the pizza here..." style="height: 200px" name="description"><?php echo $description ?? '' ?></textarea>
      <div class="invalid-feedback"><?php echo $product->description_err ?? '' ?></div>
    </div>

    <button type="submit" class="btn btn-danger bg-gradient" name="submit">Publish</button>
  </form>
</diV>

<?php include 'includes/footer.php' ?>