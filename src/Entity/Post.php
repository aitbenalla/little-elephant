<?php

namespace App\Entity;

use DateTime;
use DateTimeZone;
class Post
{
    private ?int $id = null;
    private string $title;
    private string $content;
    private string $slug;
    private bool $status;
    private int $category;
    private ?int $like_count;
    private ?int $dislike_count;
    private ?string $tags;
    private ?DateTime $created_at;
    private ?DateTime $updated_at;
    private int $author;

    public function __construct()
    {
        $datetime = new DateTime('NOW');
        $datetime->setTimezone(new DateTimeZone('Africa/Casablanca'));
        $this->created_at = $datetime;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getCategory(): int
    {
        return $this->category;
    }

    /**
     * @param int $category
     */
    public function setCategory(int $category): void
    {
        $this->category = $category;
    }

    /**
     * @return int
     */
    public function getLikeCount(): int
    {
        return $this->like_count;
    }

    /**
     * @param int $like_count
     */
    public function setLikeCount(int $like_count): void
    {
        $this->like_count = $like_count;
    }

    /**
     * @return int
     */
    public function getDislikeCount(): int
    {
        return $this->dislike_count;
    }

    /**
     * @param int $dislike_count
     */
    public function setDislikeCount(int $dislike_count): void
    {
        $this->dislike_count = $dislike_count;
    }

    /**
     * @return string
     */
    public function getTags(): string
    {
        return $this->tags;
    }

    /**
     * @param string $tags
     */
    public function setTags(string $tags): void
    {
        $this->tags = $tags;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->created_at;
    }

    /**
     * @param DateTime|null $created_at
     */
    public function setCreatedAt(?DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updated_at;
    }

    /**
     * @param DateTime|null $updated_at
     */
    public function setUpdatedAt(?DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return int
     */
    public function getAuthor(): int
    {
        return $this->author;
    }

    /**
     * @param int $author
     */
    public function setAuthor(int $author): void
    {
        $this->author = $author;
    }



}