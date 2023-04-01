<?php

class RegisterModel extends Db
{
  public function register($username, $email, $password)
  {
    $hash_pass = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $this->connect()->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $email, $hash_pass])) {
      session_start();

      $stmt = $this->connect()->prepare("SELECT * FROM users WHERE email=?");
      $stmt->execute([$email]);
      $result = $stmt->fetch();

      $_SESSION['id'] = $result['id'];
      $_SESSION['username'] = $result['username'];
      $_SESSION['email'] = $result['email'];
    }
  }
}
