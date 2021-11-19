<?php
namespace App\Model;
class MemberRepository extends Database {

    public function getAll()
    {
        $sql = 'SELECT * FROM member';
        $members = $this->getConnection()->query($sql)->fetchAll();

        return $members;
    }

    public function add()
    {
        
    }

}