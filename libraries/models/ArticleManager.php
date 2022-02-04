<?php 

namespace Models;

class ArticleManager extends ModelManager
{
    protected $table = 'article';

    public function insert(string $title,string $sub_title,string $content)
    {
        $sql = "INSERT INTO article (title, sub_title, content) VALUES (:title, :sub_title, :content)";
        $query = $this->pdo->prepare($sql);

        if (!$query->execute(compact('title', 'sub_title', 'content'))) {
            echo "\nPDOStatement::errorInfo():\n";
            $arr = $query->errorInfo();
            print_r($arr);
        }
    }

    public function update(int $id, string $title, string $subtitle, string $content)
    {
       $sql = "UPDATE article SET title = :title, sub_title = :subtitle, content = :content WHERE id = :id";
       $query = $this->pdo->prepare($sql);
       

       if (!$query->execute(compact('title', 'subtitle', 'content', 'id'))) {
           echo "\nPDOStatement::errorInfo():\n";
           $arr = $query->errorInfo();
           print_r($arr);
       } 
    }
}