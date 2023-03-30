<?php

class ProductController extends ProductModel
{
  private $image;
  private $title;
  private $description;
  private $id;
  public $image_err;
  public $title_err;
  public $description_err;

  public function __construct($image, $title, $description, $id)
  {
    $this->image = $image;
    $this->title = $title;
    $this->description = $description;
    $this->id = $id;
  }

  public function create_product()
  {
    $this->create($this->image, $this->title, $this->description);

    if (!$this->validate_image()) {
      $this->image_err = 'Exceeded character limit.';
      return;
    }
    if (!$this->validate_title()) {
      $this->title_err = 'Title must be less than 40 characters.';
      return;
    }
    if (!$this->validate_description()) {
      $this->description_err = 'Description must be less than 2000 characters.';
      return;
    }

    header('Location: index.php');
  }

  public function update_product()
  {
    $this->update($this->image, $this->title, $this->description, $this->id);

    if (!$this->validate_image()) {
      $this->image_err = 'Exceeded character limit.';
      return;
    }
    if (!$this->validate_title()) {
      $this->title_err = 'Title must be less than 40 characters.';
      return;
    }
    if (!$this->validate_description()) {
      $this->description_err = 'Description must be less than 2000 characters.';
      return;
    }

    header('Location: index.php');
  }

  private function validate_image()
  {
    if (strlen($this->image) > 1000) {
      $result = false;
    } else {
      $result = true;
    }

    return $result;
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
