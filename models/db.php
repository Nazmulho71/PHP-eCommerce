<?php

class Db
{
  private $host = 'localhost';
  private $dbname = 'ecommerce';
  private $username = 'root';
  private $password = '';

  protected function connect()
  {
    try {
      $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      return $pdo;
    } catch (PDOException $e) {
      die('Error: ' . $e->getMessage());
    }
  }
}
