<?php

class RegisterController extends RegisterModel
{
  private $username;
  private $email;
  private $password;
  public $username_err;
  public $email_err;
  public $pass_err;

  public function __construct($username, $email, $password)
  {
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
  }

  public function register_user()
  {
    $this->register($this->username, $this->email, $this->password);

    if (!$this->validate_username()) {
      $this->username_err = 'Name must be 3 characters or more.';
      return;
    }
    if (!$this->validate_email()) {
      $this->email_err = 'Please enter a valid email.';
      return;
    }
    if (!$this->validate_password()) {
      $this->pass_err = 'Password must be 3 characters or more.';
      return;
    }

    header('Location: index.php');
  }

  public function validate_username()
  {
    if (strlen($this->username) < 3 || empty($this->username)) {
      $result = false;
    } else {
      $result = true;
    }

    return $result;
  }

  public function validate_email()
  {
    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL) || empty($this->email)) {
      $result = false;
    } else {
      $result = true;
    }

    return $result;
  }

  public function validate_password()
  {
    if (strlen($this->password) < 5  || empty($this->password)) {
      $result = false;
    } else {
      $result = true;
    }

    return $result;
  }
}
