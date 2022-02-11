<?php 

namespace Models;

use Models\Entity\ArticleEntity;

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

    public function findAll()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY created_at desc";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        
        /*
        $articles = $query->fetchAll();

        $listArticleEntity = [];
        foreach($articles as $article) {
            $articleEntity = new ArticleEntity();
            $articleEntity->hydrate($article);
            $listArticleEntity[] = $articleEntity;
        }
        */

        $listArticleEntity = $query->fetchAll(\PDO::FETCH_CLASS, '\\models\\Entity\\ArticleEntity');
        return $listArticleEntity;
    }

    public function find(int $id):ArticleEntity
    {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");

        // On exécute la requête en précisant le paramètre :article_id 
        $query->execute(['id' => $id]);
        $query->setFetchMode(\PDO::FETCH_CLASS, '\\models\\Entity\\ArticleEntity');
        $article = $query->fetch();

        return $article;
        
    }

    public function delete(int $id):void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }
}