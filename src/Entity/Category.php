<?php

namespace App\Entity;

class Category
{
    private ?int $id;
    private string $name;
    private string $slut;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSlut(): string
    {
        return $this->slut;
    }

    /**
     * @param string $slut
     */
    public function setSlut(string $slut): void
    {
        $this->slut = $slut;
    }
}