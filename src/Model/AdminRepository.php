<?php

namespace App\Model;

use App\Entity\Admin;
use PDO;
use PDOException;
class AdminRepository extends Database
{
    public function flush(Admin $admin): bool|int|string|null
    {
        try {
            $sql = 'INSERT INTO admin(full_name,email,password,role,created_at) 
                    VALUES(
                        :full_name,
                        :email,
                        :password,
                        :role,
                        :created_at
                        )';

            if ($admin->getId()) {
                $sql = 'UPDATE admin SET 
                        full_name = :full_name,
                        email = :email,
                        password = :password,
                        role = :role
                        WHERE id = :id
                        ';
            }

            $conn = $this->getConnection();

            $stmt = $conn->prepare($sql);
            if ($admin->getId()) {
                $stmt->bindValue(":id", $admin->getId());
            }
            $stmt->bindValue(":full_name", $admin->getFullName());
            $stmt->bindValue(":email", $admin->getEmail());
            $stmt->bindValue(":password", $admin->getPassword());
            $stmt->bindValue(":role", $admin->getRole());
            if ($admin->getCreatedAt())
            {
                $stmt->bindValue(":created_at", $admin->getCreatedAt()->format('Y-m-d H:i:s'));
            }
            $stmt->execute();

            $admin_id = $conn->lastInsertId();

            if ($admin->getId()) {
                return $admin->getId();
            }

            return $admin_id;
        }
        catch (PDOException $th)
        {
            return $th->getMessage();
        }
    }

    public function getAuth($email)
    {
        try {
            $conn = $this->getConnection();

            $stmt = $conn->prepare('SELECT * FROM admin WHERE email = ?');
//            $stmt->bindParam(':email', $email);
            $stmt->execute([$email]);

            $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Admin::class);

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