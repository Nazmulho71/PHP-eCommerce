<?php

class LoginController extends LoginModel
{
  private $email;
  private $password;
  public $email_err;
  public $pass_err;

  public function __construct($email, $password)
  {
    $this->email = $email;
    $this->password = $password;
  }

  public function login_user()
  {
    $this->login($this->email, $this->password);

    if (!$this->validate_email()) {
      $this->email_err = 'Please enter a valid email.';
      return;
    }
    if (!$this->email_exists) {
      $this->email_err = 'Email does not exists.';
      return;
    }
    if (!$this->pass_exists) {
      $this->pass_err = 'Wrong password.';
      return;
    }

    header('Location: index.php');
  }

  public function validate_email()
  {
    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      $result = false;
    } else {
      $result = true;
    }

    return $result;
  }
}
