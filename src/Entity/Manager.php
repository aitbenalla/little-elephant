<?php

namespace App\Entity;

use DateTime;
use DateTimeZone;
class Manager
{
    private ?int $id = null;
    private string $full_name;
    private string $email;
    private string $password;
    private string $role;
    private DateTime | string $created_at;

    public function __construct()
    {
        $datetime = new DateTime('NOW');
        $datetime->setTimezone(new DateTimeZone('Africa/Casablanca'));
        $this->created_at = $datetime;
        $this->role = 'ROLE_MANAGER';
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
    public function getFullName(): string
    {
        return $this->full_name;
    }

    /**
     * @param string $full_name
     */
    public function setFullName(string $full_name): void
    {
        $this->full_name = $full_name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * @return DateTime|string
     */
    public function getCreatedAt(): DateTime|string
    {
        return $this->created_at;
    }

    /**
     * @param DateTime|string $created_at
     */
    public function setCreatedAt(DateTime|string $created_at): void
    {
        $this->created_at = $created_at;
    }
}