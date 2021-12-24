<?php

namespace App\Model;

use PDO;
use PDOException;

class Database
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

            return true;
        } else {
            return false;
        }
    }

    public function getConnection(): PDO|string
    {
        try {
            $connection = new PDO("mysql:host=$this->servername;dbname=little_elephant", $this->username, $this->password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $th) {

            return $th->getMessage();
        }
    }

    public function getServer(): PDO|string
    {
        try {
            $connection = new PDO("mysql:host=$this->servername", $this->username, $this->password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $connection;
        } catch (PDOException $th) {

            return $th->getMessage();
        }
    }

    public function createDatabase(): bool|string
    {
        try {
            $conn = $this->getServer();
            $sql = "CREATE DATABASE `little_elephant`";
            $conn->exec($sql);
            return true;
        } catch (PDOException $th) {
            return $th->getMessage();
        }

    }

//  public function dropDatabase(): bool|string
//  {
//    try {
//      $conn = $this->getServer();
//      $sql = "DROP DATABASE `little_elephant`";
//      $conn->exec($sql);
//      return true;
//    } catch (PDOException $th) {
//      return $th->getMessage();
//    }
//
//  }

    public function createTableAuthor(): bool|string
    {
        try {

            $sql = "CREATE TABLE `author` (
        `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
        `full_name` VARCHAR(60),
        `birth_date` DATE NOT NULL,
        `username` VARCHAR(50) NOT NULL,
        `phone` INT(50),
        `email` VARCHAR(180) NOT NULL UNIQUE,
        `password` VARCHAR(61) NOT NULL,
        `city` VARCHAR(20),
        `country` VARCHAR(20),
        `address` LONGTEXT,
        `created_at` DATETIME NOT NULL,
        `updated_at` DATETIME
        )ENGINE=InnoDB;";

            $this->getConnection()->exec($sql);

            return true;
        } catch (PDOException $th) {
            return $th->getMessage();
        }


    }

    public function createTableCategory(): bool|string
    {
        try {

            $sql = "CREATE TABLE `category` (
        `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(100) NOT NULL,
        `slug` LONGTEXT NOT NULL
      )ENGINE=InnoDB;";

            $this->getConnection()->exec($sql);

            return true;
        } catch (PDOException $th) {
            return $th->getMessage();
        }
    }

    public function createTablePost(): bool|string
    {
        try {

            $sql = "CREATE TABLE `post` (
        `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(180) NOT NULL,
        `content` LONGTEXT NOT NULL,
        `slug` LONGTEXT NOT NULL,
        `updated_at` DATETIME,
        `created_at` DATETIME NOT NULL,
        author_id INT NOT NULL,
        category_id INT NOT NULL,
        FOREIGN KEY (author_id) REFERENCES author(id),
        FOREIGN KEY (category_id) REFERENCES category(id)
      )ENGINE=InnoDB;";

            $this->getConnection()->exec($sql);

            return true;
        } catch (PDOException $th) {
            return $th->getMessage();
        }


    }

    public function createTableMediaAuthor(): bool|string
    {
        try {

            $sql = "CREATE TABLE `media_author` (
        `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
        `type` VARCHAR(25) NOT NULL,
        `name` LONGBLOB NOT NULL,
        author_id INT NOT NULL,
        FOREIGN KEY (author_id) REFERENCES author(id)
        ON DELETE CASCADE
        ON UPDATE RESTRICT
      )ENGINE=InnoDB;";

            $this->getConnection()->exec($sql);

            return true;
        } catch (PDOException $th) {
            return $th->getMessage();
        }

    }

    public function createTableMediaPost(): bool|string
    {
        try {

            $sql = "CREATE TABLE `media_post` (
        `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
        `type` VARCHAR(25) NOT NULL,
        `name` LONGBLOB NOT NULL,
        post_id INT NOT NULL,
        FOREIGN KEY (post_id) REFERENCES post(id)
        ON DELETE CASCADE
        ON UPDATE RESTRICT
      )ENGINE=InnoDB;";

            $this->getConnection()->exec($sql);

            return true;
        } catch (PDOException $th) {
            return $th->getMessage();
        }

    }

    public function createTableManager(): bool|string
    {
        try {
            $sql = "CREATE TABLE `manager` (
        `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
        `full_name` VARCHAR(60),
        `email` VARCHAR(180) NOT NULL UNIQUE,
        `password` VARCHAR(61) NOT NULL,
        `role` LONGTEXT NOT NULL,
        `created_at` DATETIME NOT NULL
        )ENGINE=InnoDB;";

            $this->getConnection()->exec($sql);

            return true;
        } catch (PDOException $th) {
            return $th->getMessage();
        }


    }
}
