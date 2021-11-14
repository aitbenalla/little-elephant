<?php

class Database
{

  public function __construct(public string $servername, public string $username, public string $password)
  {
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

  public function createTableMembers()
  {
    try {
      $conn = $this->getConnection();
      $sql = "CREATE TABLE Members (
        `id` INT(11) UNSIGNED AUTO_INCREMENT,
        `firstname` VARCHAR(30),
        `lastname` VARCHAR(30),
        `birth_date` DATE NOT NULL,
        `username` VARCHAR(50),
        `phone` INT(50),
        `email` VARCHAR(180),
        `password` VARCHAR(61),
        `city` VARCHAR(20),
        `country` VARCHAR(20),
        `zip` VARCHAR(10),
        `account_type` LONGTEXT,
        `photo` LONGBLOB,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY(`id`)
        )ENGINE=InnoDB;";

      $conn->exec($sql);

      return true;
    } catch (PDOException $th) {
      return $th->getMessage();
    }

    $this->disconnect();
  }
}
