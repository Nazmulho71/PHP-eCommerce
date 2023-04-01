<?php
require '../autoload.php';

$id = $_GET['id'];
if (!isset($id)) {
  header('Location: index.php');
}

$products = new ProductModel;
$products->delete($id);
header('Location: ../index.php');
