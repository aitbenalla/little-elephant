<?php

namespace App\Model;

use App\Entity\Media;
use PDO;

class MediaRepository extends Database
{
    public function getAll()
    {
        $sql = 'SELECT * FROM media';
        $medias = $this->getConnection()->query($sql)->fetchAll(PDO::FETCH_CLASS, Media::class);

        return $medias;
    }

    public function flush(Media $media)
    {
        $conn = $this->getConnection();
        $sql = 'INSERT INTO media(name,type,member_id) 
        VALUES(
            :name,
            :type,
            :member_id
            )';

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":name", $media->getName());
        $stmt->bindValue(":type", $media->getType());
        $stmt->bindValue(":member_id", $media->getMember());

        $stmt->execute();

        return true;
    }
}
