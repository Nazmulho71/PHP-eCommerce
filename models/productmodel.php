<?php

class ProductModel extends Db
{
  public function view($filter, $search)
  {
    if ($filter == 'newest') {
      $query = "SELECT products.*, users.username FROM products LEFT JOIN users ON products.user_id = users.id WHERE products.title LIKE ? ORDER BY date ASC";
    } elseif ($filter == 'lowtohigh') {
      $query = "SELECT products.*, users.username FROM products LEFT JOIN users ON products.user_id = users.id WHERE products.title LIKE ? ORDER BY price ASC";
    } elseif ($filter == 'hightolow') {
      $query = "SELECT products.*, users.username FROM products LEFT JOIN users ON products.user_id = users.id WHERE products.title LIKE ? ORDER BY price DESC";
    } else {
      $query = "SELECT products.*, users.username FROM products LEFT JOIN users ON products.user_id = users.id WHERE products.title LIKE ?";
    }

    $stmt = $this->connect()->prepare($query);
    $stmt->execute(["%$search%"]);
    return $stmt->fetchAll();
  }

  public function view_single($id)
  {
    $stmt = $this->connect()->prepare("SELECT * FROM products LEFT JOIN users ON products.user_id = users.id WHERE products.id=?");
    $stmt->execute([$id]);
    return $stmt->fetch();
  }

  public function create($image, $title, $description, $price,  $user_id)
  {
    $stmt = $this->connect()->prepare("INSERT INTO products (image, title, description, price, user_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$image, $title, $description, $price,  $user_id]);
  }

  public function update($image, $title, $description, $price,  $id)
  {
    $stmt = $this->connect()->prepare("UPDATE products SET image=?, title=?, description=?, price=? WHERE id=?");
    $stmt->execute([$image, $title, $description, $price, $id]);
  }

  public function delete($id)
  {
    $stmt = $this->connect()->prepare("DELETE FROM products WHERE id=?");
    $stmt->execute([$id]);
  }
}
