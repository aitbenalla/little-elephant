<?php

namespace App\Model;

use App\Entity\Author;
use PDO;
use PDOException;
class AuthorRepository extends Database
{
    public function getAll(): bool|array|string
    {
        try {
            $sql = 'SELECT author.*, media_author.name, media_author.type
                    FROM author
                    LEFT JOIN media_author ON author.id = media_author.author_id';
            return $this->getConnection()->query($sql)->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Author::class);
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
            $stmt = $conn->prepare('SELECT * FROM author WHERE id=? LIMIT 1');

            $stmt->execute([$id]);
            $stmt->setFetchMode(PDO::FETCH_CLASS, Author::class);

            return $stmt->fetch();
        }
        catch (PDOException $th)
        {
            return $th->getMessage();
        }

    }

    public function flush(Author $author): bool|int|string|null
    {
        try {
            $sql = 'INSERT INTO author(full_name,birth_date,username,phone,email,password,address,city,country,created_at) 
                    VALUES(
                        :full_name,
                        :birth_date,
                        :username,
                        :phone,
                        :email,
                        :password,
                        :address,
                        :city,
                        :country,
                        :created_at
                        )';

            if ($author->getId()) {
                $sql = 'UPDATE author SET 
                        full_name = :full_name,
                        birth_date = :birth_date,
                        username = :username,
                        phone = :phone,
                        email = :email,
                        password = :password,
                        address = :address,
                        city = :city,
                        country = :country,
                        updated_at = :updated_at
                        WHERE id = :id
                        ';
            }

            $conn = $this->getConnection();
            $stmt = $conn->prepare($sql);

            if ($author->getId()) {
                $stmt->bindValue(":id", $author->getId());
                $stmt->bindValue(":updated_at", $author->getUpdatedAt());
            }
            $stmt->bindValue(":full_name", $author->getFullName());
            $stmt->bindValue(":birth_date", $author->getBirthDate());
            $stmt->bindValue(":username", $author->getUsername());
            $stmt->bindValue(":phone", $author->getPhone());
            $stmt->bindValue(":email", $author->getEmail());
            $stmt->bindValue(":password", $author->getPassword());
            $stmt->bindValue(":address", $author->getAddress());
            $stmt->bindValue(":city", $author->getCity());
            $stmt->bindValue(":country", $author->getCountry());
            if ($author->getCreatedAt())
            {
                $stmt->bindValue(":created_at", $author->getCreatedAt()->format('Y-m-d H:i:s'));
            }

            $stmt->execute();

            $author_id = $conn->lastInsertId();

            if ($author->getId()) {
                return $author->getId();
            }

            return $author_id;
        }
        catch (PDOException $th)
        {
            return $th->getMessage();
        }

    }

    public function delete(int $id): bool
    {
        try {
            $stmt = $this->getConnection()->prepare( "DELETE FROM author WHERE id=:id" );
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->rowCount();
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

            $stmt = $conn->prepare('SELECT * FROM author WHERE email = ?');
            $stmt->execute([$email]);

            $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Author::class);

            return $stmt->fetch();
        }
        catch (PDOException $th)
        {
            return $th->getMessage();
        }
    }
}
