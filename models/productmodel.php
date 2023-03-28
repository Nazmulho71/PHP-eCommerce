<?php

class ProductModel extends Db
{
  public function create($image, $title, $description)
  {
    $stmt = $this->connect()->prepare("INSERT INTO products (image, title, description) VALUES (?, ?, ?)");
    $stmt->execute([$image, $title, $description]);
  }
}
