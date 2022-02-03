<?php
namespace Models\Entity;

class ArticleEntity
{
    private $id;
    private $first_name;
    private $email;
    private $password;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getFirstName(){
        return $this->first_name;
    }

    public function setFirstName($first_name){
        $this->first_name = $first_name;
    }

    public function getemail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }
}