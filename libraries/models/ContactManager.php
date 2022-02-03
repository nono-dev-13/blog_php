<?php 

namespace Models;

class ContactManager extends ModelManager
{
    protected $table = 'contact';

    public function postContact(string $name,string $email,string $subject,string $message)
    {

        $sql = "INSERT INTO contact (name, email,subject,message) VALUES (:name, :email,:subject,:message)";
        $query = $this->pdo->prepare($sql);

        if (!$query->execute(compact('name', 'email', 'subject', 'message'))) {
            echo "\nPDOStatement::errorInfo():\n";
            $arr = $query->errorInfo();
            print_r($arr);
        }

    }
}