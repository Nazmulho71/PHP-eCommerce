<?php

class ProductModel extends Db
{
  public function view()
  {
    $stmt = $this->connect()->query('SELECT * FROM products');
    return $stmt->fetchAll();
  }

  public function create($image, $title, $description)
  {
    $stmt = $this->connect()->prepare("INSERT INTO products (image, title, description) VALUES (?, ?, ?)");
    $stmt->execute([$image, $title, $description]);
  }

  public function delete($id)
  {
    $stmt = $this->connect()->prepare("DELETE FROM products WHERE id=?");
    $stmt->execute([$id]);
  }
}
