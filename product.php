<?php include 'includes/header.php' ?>

<?php
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

<div class="p-5">
  <a href="index.php">← Go back</a><br>

  <div class="d-flex align-items-center mt-3">
    <img class="rounded-3" src="<?php echo $product['image'] ? $product['image'] : 'https://platerate.com/images/tempfoodnotext.png' ?>" alt="" height="300px">

    <div class="w-100 ps-5">
      <div class="d-flex align-items-center justify-content-between">
        <h1><?php echo $product['title'] ?></h1>
        <h1>$ <?php echo $product['price'] ?></h1>
      </div>
      <hr>
      <p class="py-4"><?php echo $product['description'] ?></p>
      <?php if ($_SESSION['username'] == $product['username']) : ?>
        <a href="update_product.php?id=<?php echo $id ?>"><button class="btn btn-dark btn-lg bg-gradient me-2">Update</button></a>
        <a href="includes/delete_product.php?id=<?php echo $id ?>"><button class="btn btn-danger btn-lg bg-gradient">Delete</button></a>
      <?php else : ?>
        <a href="#"><button class="btn btn-dark btn-lg bg-gradient me-2">Add to cart</button></a>
        <a href="#"><button class="btn btn-danger btn-lg bg-gradient">Order Now</button></a>
      <?php endif ?>
    </div>
  </div>

  <div class="mt-5">
    <h3>Comments</h3>
    <hr>

    <form action="" method="post">
      <textarea class="form-control" name="comment" id="" cols="30" rows="5"></textarea>
      <button type="submit" name="submit" class="btn btn-outline-dark bg-gradient w-100">Comment</button><br>
    </form>

    <div class="mt-4">
      <?php foreach ($comments as $comment) : ?>
        <div class="mb-4">
          <b><?php echo $_SESSION['username'] == $comment['name'] ? 'You' : $comment['name'] ?> - <?php echo date('m/d/Y', strtotime($comment['date'])); ?></b>
          <?php if (isset($_GET['comment_id']) && $_GET['comment_id'] == $comment['id']) : ?>
            <form action="" method="post">
              <textarea class="form-control" name="edit_comment"><?php echo $comment['comment'] ?></textarea>
              <input type="hidden" name="edit_commentid" value="<?php echo $comment['id'] ?>">
              <button type="submit" name="save" class="btn btn-danger btn-sm bg-gradient w-100">Save</button>
            </form>
          <?php else : ?>
            <p><?php echo $comment['comment'] ?></p>
            <?php if ($_SESSION['username'] == $comment['name']) : ?>
              <a class=" me-2" href="product.php?id=<?php echo $id ?>&comment_id=<?php echo $comment['id'] ?>">
                <button class="btn btn-outline-dark btn-sm bg-gradient">Update</button>
              </a>
              <a href="includes/delete_comment.php?product_id=<?php echo $id ?>&comment_id=<?php echo $comment['id'] ?>">
                <button class="btn btn-outline-danger btn-sm bg-gradient">
                  Delete
                </button></a>
            <?php endif ?>
          <?php endif ?>

        </div>
      <?php endforeach ?>
    </div>
  </div>
</diV>

<?php include 'includes/footer.php' ?>