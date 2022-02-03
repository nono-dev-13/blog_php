<?php
namespace Models\Entity;

class ArticleEntity
{
    private $id;
    private $author;
    private $content;
    private $created_at;
    private $article_id;
    
    

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

    public function setCreatedAt($created_at){
        $this->created_at = $created_at;
    }

    public function getArticleId(){
        return $this->article_id;
    }

    public function setSubTitle($article_id){
        $this->article_id = $article_id;
    }
}