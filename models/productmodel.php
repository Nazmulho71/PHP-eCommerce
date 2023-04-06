<?php

class ProductModel extends Db
{
  public function view($filter)
  {
    if ($filter == 'lowtohigh') {
      $query = "SELECT products.*, users.username FROM products LEFT JOIN users ON products.user_id = users.id ORDER BY price ASC";
    } elseif ($filter == 'hightolow') {
      $query = "SELECT products.*, users.username FROM products LEFT JOIN users ON products.user_id = users.id ORDER BY price DESC";
    } else {
      $query = "SELECT products.*, users.username FROM products LEFT JOIN users ON products.user_id = users.id ORDER BY date ASC";
    }

    $stmt = $this->connect()->query($query);
    return $stmt->fetchAll();
  }

  public function view_single($id)
  {
    $stmt = $this->connect()->prepare("SELECT * FROM products WHERE products.id=?");
    $stmt->execute([$id]);
    return $stmt->fetch();
  }

  public function create($image, $title, $description, $user_id)
  {
    $stmt = $this->connect()->prepare("INSERT INTO products (image, title, description, user_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$image, $title, $description, $user_id]);
  }

  public function update($image, $title, $description, $id)
  {
    $stmt = $this->connect()->prepare("UPDATE products SET image=?, title=?, description=? WHERE id=?");
    $stmt->execute([$image, $title, $description, $id]);
  }

  public function delete($id)
  {
    $stmt = $this->connect()->prepare("DELETE FROM products WHERE id=?");
    $stmt->execute([$id]);
  }
}
