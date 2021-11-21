<?php
namespace App\Entity;

class Media {

    private $id,
            $name,
            $type,
            $member;

    public function __construct()
    {
        
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getMember()
    {
        return $this->member;
    }

    public function setMember($member)
    {
        $this->member = $member;
    }

}