<?php

class ProfileModel extends Db
{

  public function update($username, $email, $password)
  {
    $stmt = $this->connect()->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$_SESSION['email']]);
    $result = $stmt->fetch();

    if ($_SESSION['email'] == @$result['email']) {
      $stmt = $this->connect()->prepare("UPDATE users SET username=?, email=?, password=? WHERE id=?");
      $hash_pass = password_hash($password, PASSWORD_DEFAULT);
      $stmt->execute([$username, $email, $hash_pass, $result['id']]);
      $_SESSION['username'] =  $username;
      $_SESSION['email'] =  $email;
      $_SESSION['password'] =  $hash_pass;
    }
  }
}
