<?php

namespace App\Entity;


class Member
{
    private string $fullname;
    private string $birthdate;
    private string $username;
    private int $phone;
    private string $email;
    private string $password;
    private string $city;
    private string $country;
    private string $account_type;
    private string $address;
    private string $image;
    private string $zip;
    private string $created_at;

    public function __construct()
    {
        $this->account_type = 'ROLE_MEMBER';
    }

    public function getFullName()
    {
        return $this->fullname;
    }

    public function setFullName($fullname)
    {
        $this->fullname = $fullname;
    }

    public function getBirthDate()
    {
        return $this->birthdate;
    }

    public function setBirthDate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }
    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }
    public function getAccountType()
    {
        return $this->account_type;
    }

    public function setAccountType($account_type)
    {
        $this->account_type = $account_type;
    }
    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function setImage($image)
    {
        $this->image = $image;
    }
    public function getZip()
    {
        return $this->zip;
    }
    public function setZip($zip)
    {
        $this->zip = $zip;
    }
}
