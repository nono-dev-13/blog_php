<?php 
namespace Models;

use Models\Entity\CommentEntity;

class CommentManager extends ModelManager
{
    protected $table = 'comment';

    public function findAll(int $article_id):array
    {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE article_id = :article_id");
        $query->execute(['article_id' => $article_id]);
        $commentaires = $query->fetchAll();

        $listeComments = [];
        $entityName = 'models\\Entity\\'. ucfirst($this->table) .'Entity';
        //echo "$entityName";
        foreach($commentaires as $commentaire){
            $comment = new $entityName();
            $comment->hydrate($commentaire);
            $listeComments[] = $comment;
        }

        return $listeComments;
    }

    public function insert(string $author, string $content, int $article_id):void
    {
        $sql = "INSERT INTO {$this->table} SET author = :author, content = :content, article_id = :article_id, created_at = NOW()";
        $query = $this->pdo->prepare($sql);
        $query->execute(compact('author', 'content', 'article_id'));
    }

    public function find(int $id):CommentEntity
    {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");

        // On exécute la requête en précisant le paramètre :article_id 
        $query->execute(['id' => $id]);
        $query->setFetchMode(\PDO::FETCH_CLASS, '\\models\\Entity\\CommentEntity');
        $comment = $query->fetch();

        return $comment;
        
    }

    public function delete(int $id):void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }
}