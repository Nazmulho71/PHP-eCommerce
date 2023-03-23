<?php

class LoginModel extends Db
{
  public $email_exists = true;
  public $pass_exists = true;

  public function login($email, $password)
  {
    $stmt = $this->connect()->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]);
    $result = $stmt->fetch();

    if ($email != @$result['email']) {
      $this->email_exists = false;
    }

    if (@password_verify($password, $result['password'])) {
      session_start();
      $_SESSION['username'] = $result['username'];
    } else {
      $this->pass_exists = false;
    }
  }
}
