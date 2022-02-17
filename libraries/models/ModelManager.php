<?php 
namespace Models;

use Models\Entity\ArticleEntity;

//juste une idée, une représentation, on ne veut pas qu'on l'utilise, qu'on l'instancie
abstract class ModelManager
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = \Database::getPdo();
    }
}