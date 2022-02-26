<?php
session_start();
require_once('libraries/config.php');
require_once('libraries/autoload.php');
try{
    $controllerArticle = new \Controllers\ArticleController();
    $controllerComment = new \Controllers\CommentController();
    $controllerUser = new \Controllers\UserController();
    $controllerContact = new \Controllers\ContactController();

    $page = $_REQUEST['page'] ?? 'accueil';
    
    // on définit la variable
    $role = -1;

    if(isset($_SESSION['user'])) {
        $role = $_SESSION['user']['role'];
    }
    
    $pageTrouve = false; 
    
    if($role == ROLE_ADMIN) {
        $pageTrouve = true; 
        switch($page) {
    
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
        
            case 'save-comment' :
            $controllerComment->save();
            break;
    
            case 'valid-comment' :
            $controllerComment->validation();
            break;
    
            case 'refuse-comment' :
            $controllerComment->reject();
            break;
    
            case 'delete-comment' :
            $controllerComment->delete();
            break;
                
            default : $pageTrouve = false;
        
        }
    }
    
    if($pageTrouve == false) {
        
        if($role == ROLE_USER || $role == ROLE_ADMIN) {
            $pageTrouve = true;
            switch($page) {
            
                case 'save-comment' :
                $controllerComment->save();
                break;
    
                case 'logout' :
                $controllerUser->logout();
                break;

                default : $pageTrouve = false;
            }
        }
    }
    
    if($pageTrouve == false) {
        $pageTrouve = true;
        switch($page) {
            case 'accueil' :
            $controllerContact->acceuilContact();
            break;
    
            case 'home' :
            $controllerArticle->index();
            break;
    
            case 'article' :
            $controllerArticle->show();
            break;
    
            case 'login' :
            $controllerUser->login();
            break;
    
            case 'register' :
            $controllerUser->register();
            break;

            default : $pageTrouve = false;
        }
    }

    if($pageTrouve == false) {
        echo "$page n'est pas valid";
    }    
    

} catch(Exception $e){
    echo $e->getMessage();
}



