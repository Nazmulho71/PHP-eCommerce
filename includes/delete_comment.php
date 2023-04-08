<?php
require '../autoload.php';

$product_id = $_GET['product_id'];
$comment_id = $_GET['comment_id'];
if (!isset($product_id) || !isset($comment_id)) {
  header('Location: index.php');
}

$comments = new CommentModel;
$comments->delete($comment_id);
header("Location: ../product.php?id=$product_id");
