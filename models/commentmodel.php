<?php

class CommentModel extends Db
{
  public function view($id)
  {
    $stmt = $this->connect()->prepare("SELECT * FROM comments WHERE product_id=? ORDER BY date DESC");
    $stmt->execute([$id]);
    return $stmt->fetchAll();
  }

  public function create($name, $comment, $product_id)
  {
    $stmt = $this->connect()->prepare("INSERT INTO comments (name, comment, product_id) VALUES (?, ?, ?)");
    $stmt->execute([$name, $comment, $product_id]);
  }

  public function update($comment, $id)
  {
    $stmt = $this->connect()->prepare("UPDATE comments SET comment=? WHERE id=?");
    $stmt->execute([$comment, $id]);
  }

  public function delete($id)
  {
    $stmt = $this->connect()->prepare("DELETE FROM comments WHERE id=?");
    $stmt->execute([$id]);
  }
}
