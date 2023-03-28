<?php

class RegisterModel extends Db
{
  public function register($username, $email, $password)
  {
    $hash_pass = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $this->connect()->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $email, $hash_pass])) {
      session_start();
      $_SESSION['username'] = $username;
      $_SESSION['email'] = $email;
    }
  }
}
