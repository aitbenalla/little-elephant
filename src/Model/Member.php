<?php
require_once('Database.class.php');
class Member extends Database {

    public function getAll()
    {
        $sql = 'SELECT * FROM member';
        $members = $this->getConnection()->query($sql)->fetchAll();

        return $members;
    }

}