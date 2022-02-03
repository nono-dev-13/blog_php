<?php 

namespace Models;

class UserManager extends ModelManager
{
    protected $table = 'users';

    public function insertUser(string $username, string $email, string $pass):void
    {
        $sql = "INSERT INTO {$this->table} (username,email,pass) VALUES(:username, :email, :pass)";
        $query = $this->pdo->prepare($sql);
        
        if(!$query->execute(compact('username', 'email', 'pass'))){
            echo "\nPDOStatement::errorInfo():\n";
            $arr = $query->errorInfo();
            print_r($arr);
        }
    }

    public function getUserByEmail(string $email)
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email";
        $query = $this->pdo->prepare($sql);
        $query->execute(['email' => $email]);
        $user = $query->fetch();

        return $user;
    }

    public function lastInsertIdUser()
    {
        $this->pdo->lastInsertId();
    }

}