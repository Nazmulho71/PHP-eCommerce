<?php include 'includes/header.php' ?>

<div class="p-5">
  <div class="d-flex align-items-center justify-content-between">
    <h1>Hey, <span class="text-danger bg-gradient"><?php echo $_SESSION['username'] ?? 'Guest' ?></span></h1>

    <div class="d-flex align-items-center">
      <form class="d-flex align-items-center text-nowrap" action="" method="POST">
        <label class="me-2" for="">Sort by:</label>
        <select class="form-select" aria-label="Default select example" name="filter" onchange="this.form.submit()">
          <option value="" default selected disabled>Select</option>
          <option value="newest" <?php echo @$_POST["filter"] == 'newest' ? 'selected' : '' ?>>Newest</option>
          <option value="lowtohigh" <?php echo @$_POST["filter"] == 'lowtohigh' ? 'selected' : '' ?>>Price: Low to High</option>
          <option value="hightolow" <?php echo @$_POST["filter"] == 'hightolow' ? 'selected' : '' ?>>Price: High to Low</option>
        </select>
      </form>
      <a href="create_product.php"><button class="btn btn-dark bg-gradient ms-4">Add new Pizza</button></a>
    </div>
  </div>
  <hr>

  <div class="masonry-container">
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
        <div class="masonry-item">
          <div class="item-card">
            <img class="rounded-3" src="<?php echo $product['image'] ? $product['image'] : 'https://platerate.com/images/tempfoodnotext.png' ?>" alt="Image">
            <b><?php echo @$_SESSION['username'] == $product['username'] ? 'You' : $product['username'] ?></b>
            <div class="d-flex align-items-center justify-content-between">
              <h3><a href="product.php?id=<?php echo $product['id'] ?>"><?php echo $product['title'] ?></a></h3>
              <h3>$ <?php echo $product['price'] ?></h3>
            </div>
            <p class="text-body-secondary"><?php echo $product['description'] ?></p>
            <?php if (@$_SESSION['username'] == $product['username']) : ?>
              <div class="d-flex align-items-center justify-content-between mt-3">
                <!-- <button class="btn btn-danger bg-gradient w-100 me-3"><a href="update_product.php?id=<?php echo $product['id'] ?>">Update</a></button>
                  <button class="btn btn-outline-danger bg-gradient w-100 "><a href="includes/delete_product.php?id=<?php echo $product['id'] ?>">Delete</a></button> -->
                <a class="w-100" href="product.php?id=<?php echo $product['id'] ?>"><button class="btn btn-outline-danger bg-gradient w-100">View your Pizza</button></a>
              </div>
            <?php else : ?>
              <div class="d-flex align-items-center justify-content-between mt-3">
                <a class="w-100 me-3" href="#"><button class="btn btn-danger bg-gradient w-100">Order Now</button></a>
                <a class="w-100" href="product.php?id=<?php echo $product['id'] ?>"><button class="btn btn-outline-danger bg-gradient w-100">View Menu</button></a>
              </div>
            <?php endif ?>
          </div>
        </div>
    <?php
      endforeach;
    endif ?>
  </div>
</div>

<?php include 'includes/footer.php' ?>