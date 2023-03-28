<?php

class ProfileController extends ProfileModel
{
  private $username;
  private $email;
  private $password;
  private $passmatch;
  public $username_err;
  public $email_err;
  public $pass_err;

  public function __construct($username, $email, $password, $passmatch)
  {
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
    $this->passmatch = $passmatch;
  }

  public function update_profile()
  {
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
    if (!$this->match_password()) {
      $this->pass_err = 'Password not match.';
      return;
    }

    $this->update($this->username, $this->email, $this->password);
  }

  private function validate_username()
  {
    if (strlen($this->username) < 3 || empty($this->username)) {
      $result = false;
    } else {
      $result = true;
    }

    return $result;
  }

  private function validate_email()
  {
    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL) || empty($this->email)) {
      $result = false;
    } else {
      $result = true;
    }

    return $result;
  }

  private function validate_password()
  {
    if (strlen($this->password) < 5  || empty($this->password)) {
      $result = false;
    } else {
      $result = true;
    }

    return $result;
  }

  private function match_password()
  {
    if ($this->password != $this->passmatch) {
      $result = false;
    } else {
      $result = true;
    }

    return $result;
  }
}
