<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

class TopicManager extends Manager
{

    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";


    public function __construct()
    {
        parent::connect();
    }

    public function findTopicsByCatagoryId($id)
{

    $sql = "SELECT *
            FROM ".$this->tableName." a
            WHERE a.category_id = :id
            ";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]), 
                $this->className
            );
}

public function find2TopicsByCatagoryId($categoryId)
{

    $sql = "SELECT *
            FROM ".$this->tableName." a
            WHERE a.category_id = :id
            LIMIT 2
            ";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $categoryId]), 
                $this->className
            );
}

}
