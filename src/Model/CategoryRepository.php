<?php

namespace App\Model;

use App\Entity\Category;
use PDO;
use PDOException;
class CategoryRepository extends Database
{
    public function getAll(): bool|array|string
    {
        try {
            $sql = 'SELECT * FROM category';

            return $this->getConnection()->query($sql)->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Category::class);
        }
        catch (PDOException $th)
        {
            return $th->getMessage();
        }

    }
}