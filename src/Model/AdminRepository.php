<?php

namespace App\Model;

use App\Entity\Admin;
use PDO;
use PDOException;
class AdminRepository extends Database
{
    public function getAuth($email, $password)
    {
        try {
            $conn = $this->getConnection();
            $stmt = $conn->prepare('SELECT * FROM admin WHERE email=? AND password=?');

            $stmt->execute([$email , $password]);
            $stmt->setFetchMode(PDO::FETCH_CLASS, Admin::class);

            return $stmt->fetch();
        }
        catch (PDOException $th)
        {
            return $th->getMessage();
        }
    }

    public function getOneById(int $id)
    {
        return true;
    }
}