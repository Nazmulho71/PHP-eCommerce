<?php

class ProductController extends ProductModel
{
  private $image;
  private $title;
  private $price;
  private $description;
  private $id;
  private $user_id;
  public $title_err;
  public $price_err;
  public $description_err;

  public function __construct($image, $title, $price, $description, $id, $user_id)
  {
    $this->image = $image;
    $this->title = $title;
    $this->price = $price;
    $this->description = $description;
    $this->id = $id;
    $this->user_id = $user_id;
  }

  public function create_product()
  {
    if (!$this->validate_title()) {
      $this->title_err = 'Title must be less than 40 characters.';
      return;
    }
    if (!$this->validate_price()) {
      $this->price_err = 'Free pizza not allowed!';
      return;
    }
    if (!$this->validate_description()) {
      $this->description_err = 'Description must be less than 2000 characters.';
      return;
    }

    $this->create($this->image, $this->title, $this->description, $this->price, $this->user_id);
    header('Location: index.php');
  }

  public function update_product()
  {
    if (!$this->validate_title()) {
      $this->title_err = 'Title must be less than 40 characters.';
      return;
    }
    if (!$this->validate_price()) {
      $this->price_err = 'Free pizza not allowed!';
      return;
    }
    if (!$this->validate_description()) {
      $this->description_err = 'Description must be less than 2000 characters.';
      return;
    }

    $this->update($this->image, $this->title, $this->description, $this->price, $this->id);
    header("Location: product.php?id=$this->id");
  }

  private function validate_title()
  {
    if (strlen($this->title) > 40 || empty($this->title)) {
      $result = false;
    } else {
      $result = true;
    }

    return $result;
  }

  private function validate_price()
  {
    if ($this->price == 0 || empty($this->price)) {
      $result = false;
    } else {
      $result = true;
    }

    return $result;
  }

  private function validate_description()
  {
    if (strlen($this->description) > 2000  || empty($this->description)) {
      $result = false;
    } else {
      $result = true;
    }

    return $result;
  }
}
