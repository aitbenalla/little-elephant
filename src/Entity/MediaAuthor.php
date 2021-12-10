<?php
namespace App\Entity;

class MediaAuthor {

    private ?int $id;
    private string $name;
    private string $type;
    private int $author;

    public function __construct()
    {
        
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getAuthor(): int
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

}