<?php

namespace App\Model;

use App\Entity\MediaAuthor;
//use PDO;
use PDOException;
class MediaAuthorRepository extends Database
{

//    public function getAll(): bool|array|string
//    {
//        try {
//            $sql = 'SELECT * FROM media';
//            return $this->getConnection()->query($sql)->fetchAll(PDO::FETCH_CLASS, Media::class);
//        }
//        catch (PDOException $th)
//        {
//            return $th->getMessage();
//        }
//    }

    public function flush(MediaAuthor $media, $id = null): bool|string
    {
        try {
            $conn = $this->getConnection();

            $sql = 'INSERT INTO media_author(name,type,author_id) 
                VALUES(
                    :name,
                    :type,
                    :author_id
                    )';

            if ($id) {
                $sql = 'UPDATE media_author SET name=:name, type=:type WHERE author_id = :author_id';
            }

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":name", $media->getName());
            $stmt->bindValue(":type", $media->getType());
            $stmt->bindValue(":author_id", $media->getAuthor());

            $stmt->execute();

            return true;
        }
        catch (PDOException $th)
        {
            return $th->getMessage();
        }

    }
}
