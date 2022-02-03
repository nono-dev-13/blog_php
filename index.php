<?php
session_start();
require_once('libraries/autoload.php');
try{
    $controllerArticle = new \Controllers\ArticleController();
    $controllerComment = new \Controllers\CommentController();
    $controllerUser = new \Controllers\UserController();
    $controllerContact = new \Controllers\ContactController();

    $page = $_REQUEST['page'] ?? 'accueil';

    switch($page) {
        case 'accueil' :
        $controllerContact->acceuilContact();
        break;

        case 'home' :
        $controllerArticle->index();
        break;
    
        case 'management' :
        $controllerArticle->back();
        break;
    
        case 'add-article' :
        $controllerArticle->add();
        break;
    
        case 'edit-article' :
        $controllerArticle->edit();
        break;

        case 'delete-article' :
        $controllerArticle->delete();
        break;
    
        case 'article' :
        $controllerArticle->show();
        break;
    
        case 'save-comment' :
        $controllerComment->save();
        break;

        case 'delete-comment' :
        $controllerComment->delete();
        break;

        case 'login' :
        $controllerUser->login();
        break;

        case 'logout' :
        $controllerUser->logout();
        break;

        case 'register' :
        $controllerUser->register();
        break;
    }

} catch(Exception $e){
    echo $e->getMessage();
}



