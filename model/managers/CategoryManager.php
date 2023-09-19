<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class CategoryManager extends Manager{

        protected $className = "Model\Entities\Category";
        protected $tableName = "category";


        public function __construct(){
            parent::connect();
        }

        public function searchCategory($request)
        {
    
            $sql = "SELECT *
                        FROM " . $this->tableName . " a
                        WHERE a.categoryName LIKE :request
                        ";
    
            return $this->getMultipleResults(
                DAO::select($sql, ['request' => $request]),
                $this->className
            );
        }

}