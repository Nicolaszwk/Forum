<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class UserManager extends Manager{

        protected $className = "Model\Entities\User";
        protected $tableName = "user";


        public function __construct(){
            parent::connect();
        }

        public function findOneByUsername($username)
        {
            $sql = "SELECT *
                    FROM ".$this->tableName." u
                    WHERE u.pseudo = :username";
    
            return $this->getOneOrNullResult(
                DAO::select($sql, ['username' => $username], false),
                $this->className
            );
        }

        public function findOneByEmail($email)
        {
            $sql = "SELECT u.email 
                    FROM ".$this->tableName." u
                    WHERE u.email = :email";
    
            return $this->getOneOrNullResult(
                DAO::select($sql, ['email' => $email], false),
                $this->className
            );
        }
        public function findOneByRegisteredUser($username, $password)
        {
            $sql = "SELECT u.pseudo, u.passWord 
                    FROM ".$this->tableName." u
                    WHERE u.pseudo = :username and u.passWord = :password";
    
            return $this->getOneOrNullResult(
                DAO::select($sql, ['username' => $username, 'password' => $password], false),
                $this->className
            );
        }
    }