<?php

namespace App\Model;

use App\Entity\Post;
use PDO;
use PDOException;
class PostRepository extends Database
{
    public function flush(Post $post): bool|int|string|null
    {
        try {
            $sql = 'INSERT INTO post(title,slug,content,status,author_id,category_id,created_at) 
                    VALUES(
                        :title,
                        :slug,
                        :content,
                        :status,
                        :author_id,
                        :category_id,
                        :created_at
                        )';

            if ($post->getId()) {
                $sql = 'UPDATE post SET 
                        title = :title,
                        slug = :slug,
                        content = :content,
                        status = :status,
                        category_id = :category_id,
                        updated_at = :updated_at
                        WHERE id = :id
                        ';
            }

            $conn = $this->getConnection();

            $stmt = $conn->prepare($sql);
            if ($post->getId()) {
                $stmt->bindValue(":id", $post->getId());
                $stmt->bindValue(":updated_at", $post->getUpdatedAt()->format('Y-m-d H:i:s'));
            }
            $stmt->bindValue(":title", $post->getTitle());
            $stmt->bindValue(":slug", $post->getSlug());
            $stmt->bindValue(":content", $post->getContent());
            $stmt->bindValue(":status", $post->isStatus());
            $stmt->bindValue(":author_id", $post->getAuthor());
            $stmt->bindValue(":category_id", $post->getCategory());
            if ($post->getCreatedAt())
            {
                $stmt->bindValue(":created_at", $post->getCreatedAt()->format('Y-m-d H:i:s'));
            }
            $stmt->execute();

            $post_id = $conn->lastInsertId();

            if ($post->getId()) {
                return $post->getId();
            }

            return $post_id;
        }
        catch (PDOException $th)
        {
            return $th->getMessage();
        }
    }
}