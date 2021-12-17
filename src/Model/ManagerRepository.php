<?php

namespace App\Model;

use App\Entity\Manager;
use PDO;
use PDOException;
class ManagerRepository extends Database
{

    public function getAll(): bool|array|string
    {
        try {
            $sql = 'SELECT * FROM manager';

            return $this->getConnection()->query($sql)->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Manager::class);
        }
        catch (PDOException $th)
        {
            return $th->getMessage();
        }

    }

    public function flush(Manager $manager): bool|int|string|null
    {
        try {
            $sql = 'INSERT INTO manager(full_name,email,password,role,created_at) 
                    VALUES(
                        :full_name,
                        :email,
                        :password,
                        :role,
                        :created_at
                        )';

            if ($manager->getId()) {
                $sql = 'UPDATE manager SET 
                        full_name = :full_name,
                        email = :email,
                        password = :password,
                        role = :role
                        WHERE id = :id
                        ';
            }

            $conn = $this->getConnection();

            $stmt = $conn->prepare($sql);
            if ($manager->getId()) {
                $stmt->bindValue(":id", $manager->getId());
            }
            $stmt->bindValue(":full_name", $manager->getFullName());
            $stmt->bindValue(":email", $manager->getEmail());
            $stmt->bindValue(":password", $manager->getPassword());
            $stmt->bindValue(":role", $manager->getRole());
            if ($manager->getCreatedAt())
            {
                $stmt->bindValue(":created_at", $manager->getCreatedAt()->format('Y-m-d H:i:s'));
            }
            $stmt->execute();

            $manager_id = $conn->lastInsertId();

            if ($manager->getId()) {
                return $manager->getId();
            }

            return $manager_id;
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

            $stmt = $conn->prepare('SELECT * FROM manager WHERE email = ?');
//            $stmt->bindParam(':email', $email);
            $stmt->execute([$email]);

            $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Manager::class);

            return $stmt->fetch();
        }
        catch (PDOException $th)
        {
            return $th->getMessage();
        }
    }

    public function getOneById(int $id)
    {
        try {
            $conn = $this->getConnection();
            $stmt = $conn->prepare('SELECT * FROM manager WHERE id=? LIMIT 1');

            $stmt->execute([$id]);
            $stmt->setFetchMode(PDO::FETCH_CLASS, Manager::class);

            return $stmt->fetch();
        }
        catch (PDOException $th)
        {
            return $th->getMessage();
        }
    }
}