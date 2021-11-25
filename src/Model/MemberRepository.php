<?php

namespace App\Model;

use App\Entity\Member;
use PDO;

class MemberRepository extends Database
{

    public function getAll()
    {
        $sql = 'SELECT member.*, media.name, media.type
        FROM member
        LEFT JOIN media ON member.id = media.member_id';
        $members = $this->getConnection()->query($sql)->fetchAll(PDO::FETCH_CLASS, Member::class);

        return $members;
    }

    public function getOneById(int $id)
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare('SELECT * FROM member WHERE id=? LIMIT 1');

        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Member::class);

        return $stmt->fetch();
    }

    public function flush(Member $member)
    {
        $sql = 'INSERT INTO member(full_name,birth_date,username,phone,email,password,address,city,country,zip,role) 
        VALUES(
            :full_name,
            :birth_date,
            :username,
            :phone,
            :email,
            :password,
            :address,
            :city,
            :country,
            :zip,
            :role
            
            )';

        if ($member->getId()) {
            $sql = 'UPDATE member SET 
            full_name = :full_name,
            birth_date = :birth_date,
            username = :username,
            phone = :phone,
            email = :email,
            password = :password,
            address = :address,
            city = :city,
            country = :country,
            zip = :zip,
            role = :role
            WHERE id = :id
            ';
        }

        $conn = $this->getConnection();

        $stmt = $conn->prepare($sql);
        if ($member->getId()) {
            $stmt->bindValue(":id", $member->getId());
        }
        $stmt->bindValue(":full_name", $member->getFullName());
        $stmt->bindValue(":birth_date", $member->getBirthDate());
        $stmt->bindValue(":username", $member->getUsername());
        $stmt->bindValue(":phone", $member->getPhone());
        $stmt->bindValue(":email", $member->getEmail());
        $stmt->bindValue(":password", $member->getPassword());
        $stmt->bindValue(":address", $member->getAddress());
        $stmt->bindValue(":city", $member->getCity());
        $stmt->bindValue(":country", $member->getCountry());
        $stmt->bindValue(":zip", $member->getZip());
        $stmt->bindValue(":role", $member->getRole());

        $stmt->execute();

        $member_id = $conn->lastInsertId();

        if ($member->getId()) {
            return $member->getId();
        }

        return $member_id;
    }

    public function edit(int $id)
    {
    }

    public function delete(int $id)
    {
    }
}
