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

    public function flush(Member $member)
    {
        $conn = $this->getConnection();
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
 
        $stmt = $conn->prepare($sql);
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

        return $member_id;
    }
}
