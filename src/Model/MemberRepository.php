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
        $sql = 'INSERT INTO member(full_name,birth_date,username,phone,email,password,address,city,country,zip,account_type,image) 
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
        :account_type,
        :image
        )';

        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(":full_name", $member->getFullName());
        $stmt->bindParam(":birth_date", $member->getBirthDate());
        $stmt->bindParam(":username", $member->getUsername());
        $stmt->bindParam(":phone", $member->getPhone());
        $stmt->bindParam(":email", $member->getEmail());
        $stmt->bindParam(":password", $member->getPassword());
        $stmt->bindParam(":address", $member->getAddress());
        $stmt->bindParam(":city", $member->getCity());
        $stmt->bindParam(":country", $member->getCountry());
        $stmt->bindParam(":zip", $member->getZip());
        $stmt->bindParam(":account_type", $member->getAccountType());
        //$stmt->bindParam(":image", $imgData);

        $stmt->execute();

        $member_id = $this->getConnection()->lastInsertId();

        return $member_id;
    }
}
