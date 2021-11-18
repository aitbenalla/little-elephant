<?php
namespace App\Model;
use PDO;
use PDOException;

class Database extends Exception
{
  public string $servername;
  public string $username;
  public string $password;

  public function __construct()
  {

    $env_file = getcwd() . "/../env.json";

    if (file_exists($env_file) && is_readable($env_file)) {
      $env_content = file_get_contents($env_file);
      $env = json_decode($env_content, true);

      $this->servername = $env['servername'];
      $this->username = $env['username'];
      $this->password = $env['password'];

    } else {
      return false;
    }

  }

  public function getConnection()
  {

    try {
      $connection = new PDO("mysql:host=$this->servername;dbname=little-elephant", $this->username, $this->password);
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      return $connection;
    } catch (PDOException $th) {

      return $th->getMessage();
    }
  }

  public function getServer()
  {
    try {
      $connection = new PDO("mysql:host=$this->servername", $this->username, $this->password);
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      return $connection;
    } catch (PDOException $th) {

      return $th->getMessage();
    }
  }

  public function disconnect(): void
  {
    $this->connection = null;
  }

  public function createDatabase()
  {
    try {
      $conn = $this->getServer();
      $sql = "CREATE DATABASE `little-elephant`";
      $conn->exec($sql);
      return true;
    } catch (PDOException $th) {
      return $th->getMessage();
    }

    $this->disconnect();
  }

  public function createTableMember()
  {
    try {

      $sql = "CREATE TABLE `member` (
        `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
        `full_name` VARCHAR(60),
        `birth_date` DATE NOT NULL,
        `username` VARCHAR(50) NOT NULL,
        `phone` INT(50) NOT NULL,
        `email` VARCHAR(180) NOT NULL,
        `password` VARCHAR(61) NOT NULL,
        `city` VARCHAR(20) NOT NULL,
        `country` VARCHAR(20) NOT NULL,
        `zip` VARCHAR(10) NOT NULL,
        `account_type` LONGTEXT,
        `address` LONGTEXT,
        `image` LONGBLOB,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )ENGINE=InnoDB;";

      $this->getConnection()->exec($sql);

      return true;
    } catch (PDOException $th) {
      return $th->getMessage();
    }

    $this->disconnect();
  }

  // public function createTableImage()
  // {
  //   try {

  //     $sql = "CREATE TABLE IF NOT EXISTS `image` (
  //       `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
  //       `type` VARCHAR(25) NOT NULL DEFAULT '',
  //       `data` LONGBLOB NOT NULL,
  //       member_id INT NOT NULL,
  //       FOREIGN KEY (member_id) REFERENCES member(id)
  //       ON DELETE CASCADE
  //       ON UPDATE RESTRICT
  //     )ENGINE=InnoDB;";

  //     $this->getConnection()->exec($sql);

  //     return true;
  //   } catch (PDOException $th) {
  //     return $th->getMessage();
  //   }

  //   $this->disconnect();
  // }
}
