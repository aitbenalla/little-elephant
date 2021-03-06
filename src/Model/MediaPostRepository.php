<?php

namespace App\Model;

use App\Entity\MediaPost;
use PDOException;
class MediaPostRepository extends Database
{
    public function flush(MediaPost $media, $id = null): bool|string
    {
        try {
            $conn = $this->getConnection();

            $sql = 'INSERT INTO media_post(name,type,post_id) 
                VALUES(
                    :name,
                    :type,
                    :post_id
                    )';

            if ($id) {
                $sql = 'UPDATE media_post SET name=:name, type=:type WHERE post_id = :post_id';
            }

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":name", $media->getName());
            $stmt->bindValue(":type", $media->getType());
            $stmt->bindValue(":post_id", $media->getPost());

            $stmt->execute();

            return true;
        }
        catch (PDOException $th)
        {
            return $th->getMessage();
        }

    }
}