<?php
namespace Models\Entity;

class CommentEntity
{
    private $id;
    private $author;
    private $content;
    private $created_at;
    private $article_id;
    private $status;
    
    public function hydrate($item)
    {
        $this->setId($item['id']);
        $this->setAuthor($item['author']);
        $this->setContent($item['content']);
        $this->setCreatedAt($item['created_at']);
        $this->setArticleId($item['article_id']);
        $this->setStatus($item['status']);
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getAuthor(){
        return $this->author;
    }

    public function setAuthor($author){
        $this->author = $author;
    }

    public function getContent(){
        return $this->content;
    }

    public function setContent($content){
        $this->content = $content;
    }

    public function getCreatedAt(){
        return $this->created_at;
    }

    public function getCreatedAtFr()
    {
        return date('d-M-Y',strtotime($this->getCreatedAt()));
    }

    public function setCreatedAt($created_at){
        $this->created_at = $created_at;
    }

    public function getArticleId(){
        return $this->article_id;
    }

    public function setArticleId($article_id){
        $this->article_id = $article_id;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }
}