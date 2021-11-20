<?php

namespace App\Model;

use App\Entity\Member;

class MemberRepository extends Database
{

    public function getAll()
    {
        $sql = 'SELECT * FROM member';
        $members = $this->getConnection()->query($sql)->fetchAll();

        return $members;
    }

    public function add(Member $member)
    {
        $conn = $this->getConnection();
        $sql = 'INSERT INTO member(full_name,birth_date,username,phone,email,password,address,city,country,zip,account_type) 
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
        :account_type
        
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
        $stmt->bindValue(":account_type", $member->getAccountType());
        //$stmt->bindValue(":image", $imgData);
   
        $stmt->execute();
      
        $member_id = $conn->lastInsertId();

        return $member_id;
    }
}
