<?php

namespace App\Model;

use App\Entity\Post;
use PDO;
use PDOException;
class PostRepository extends Database
{
    public function getAll(): bool|array|string
    {
        try {
            $sql = 'SELECT post.id,post.title,post.slug,post.content,post.status,DATE(post.created_at),
                    media_post.name as media_name, media_post.type as media_type,
                    author.username as author_username, category.name as category_name, category.slug as category_slug
                    FROM post
                    LEFT JOIN media_post ON post.id = media_post.post_id
                    LEFT JOIN author ON post.author_id = author.id
                    LEFT JOIN category ON post.category_id = category.id
                    ';
            return $this->getConnection()->query($sql)->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Post::class);
        }
        catch (PDOException $th)
        {
            return $th->getMessage();
        }

    }

    public function persist(Array $data): Post
    {
        $post = new Post();
        $post->setAuthor($_SESSION['author']->getId());

        foreach ($data as $key => $value) {
            switch ($key) {
                case 'postTitle':
                    $post->setTitle($value);
                    break;
                case 'postContent':
                    $post->setContent($value);
                    break;
                case 'postSlug':
                    $post->setSlug($value);
                    break;
                case 'postStatus':
                    if ($value)
                    {
                        $post->setStatus(1);
                    }
                    break;
                case 'postCategories':
                    $post->setCategory($value);
                    break;
                case 'postTags':
                    $tags = explode(',',$value);
                    $post->setTags(json_encode($tags));
                    break;
            }
        }

        return $post;

    }

    public function flush(Post $post): bool|int|string|null
    {
        try {
            $sql = 'INSERT INTO post(title,slug,content,status,author_id,tags,category_id,created_at) 
                    VALUES(
                        :title,
                        :slug,
                        :content,
                        :status,
                        :author_id,
                        :tags,
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
            if ($post->getTags())
            {
                $stmt->bindValue(":tags", $post->getTags());
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