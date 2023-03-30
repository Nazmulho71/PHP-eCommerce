<?php
require '../autoload.php';
$id = $_GET['id'];
$products = new ProductModel;
$products->delete($id);
header('Location: ../index.php');
