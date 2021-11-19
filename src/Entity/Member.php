<?php
namespace App\Entity;


class Member {

    public function __construct(
        private string $fullname,
        private string $birthdate,
        private string $username,
        private int $phone,
        private string $email,
        private string $password,
        private string $city,
        private string $country,
        private string $account_type,
        private string $address,
        private string $image,
        private string $created_at,

    )
    {
        
    }

    public function getFullName():string
    {
        return $this->fullname;
    }

    public function setFullName($fullname)
    {
        $this->fullname = $fullname;
    }



}