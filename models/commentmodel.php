<?php

class CommentModel extends Db
{
  public function view($id)
  {
    $stmt = $this->connect()->prepare("SELECT * FROM comments WHERE comments.product_id=?");
    $stmt->execute([$id]);
    return $stmt->fetchAll();
  }

  public function create($name, $comment, $product_id)
  {
    $stmt = $this->connect()->prepare("INSERT INTO comments (name, comment, product_id) VALUES (?, ?, ?)");
    $stmt->execute([$name, $comment, $product_id]);
  }
}
