<?php 

namespace Controllers;

use Exception;
use Models\ArticleManager;
use Models\CommentManager;
use Models\UserManager;

class ArticleController
{
    

    public function index()
    {
        /**
         * 2. Récupération des articles
         */
        $articleModel = new ArticleManager();
        $articles = $articleModel->findAll();
        
        /**
         * 3. Affichage
         */
        $pageTitle = "Accueil";
        \Renderer::render('articles/index',compact('pageTitle','articles'));
    }

    public function show()
    {
        /**
         * 1. Récupération du param "id" et vérification de celui-ci
         */
        // On part du principe qu'on ne possède pas de param "id"
        $article_id = null;

        // Mais si il y'en a un et que c'est un nombre entier, alors c'est cool
        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $article_id = $_GET['id'];
        }

        // On peut désormais décider : erreur ou pas ?!
        if (!$article_id) {
            $_SESSION['error'] = "Vous devez préciser un paramètre `id` dans l'URL !";
            
        }

        /**
         * 3. Récupération de l'article en question
         * On va ici utiliser une requête préparée car elle inclue une variable qui provient de l'utilisateur : Ne faites
         * jamais confiance à ce connard d'utilisateur ! :D
         */
        $articleModel = new ArticleManager();
        $article = $articleModel->find($article_id);
        $pageTitle = $article->getTitle();
        
        /**
         * 4. Récupération des commentaires de l'article en question
         * Pareil, toujours une requête préparée pour sécuriser la donnée filée par l'utilisateur (cet enfoiré en puissance !)
         */
        $commentModel = new CommentManager();
        $commentaires = $commentModel->findAll($article_id);

        /*
        render('articles/show', [
            'pageTitle'     => $pageTitle,
            'article'       => $article,
            'commentaires'  => $commentaires,
            'article_id'    => $article_id
        ]);
        */

        \Renderer::render('articles/show', compact('pageTitle','article','commentaires','article_id'));
    }

    public function delete()
    {
        /**
         * 1. On vérifie que le GET possède bien un paramètre "id" (delete.php?id=202) et que c'est bien un nombre
         */
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            $_SESSION['error'] = "Ho ?! Tu n'as pas précisé l'id de l'article !";
        }

        $id = $_GET['id'];

        /**
         * 3. Vérification que l'article existe bel et bien
         */
         $articleModel = new ArticleManager();
         $article = $articleModel->find($id);
        if (!$article) {
            $_SESSION['error'] = "L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !";
        }

        /**
         * 4. Réelle suppression de l'article
         */
        $articleModel->delete($id);

        /**
         * 5. Redirection vers la page d'accueil
         */

        \Http::redirect("index.php?page=management");
    }

    public function add()
    {
        if(!isset($_SESSION["user"])){
            \Http::redirect('index.php?page=login');
        }

        if (!empty($_POST)) {
            $title = $_POST['title'] ?? '';
            //post n'est pas vide, je vérifie les données
            if (isset($_POST['title'], $_POST['subtitle'], $_POST['content']) && !empty($_POST['title']) && !empty($_POST['subtitle']) && !empty($_POST['content'])) {
                //formulaire complet
                //recupère les données
                //retire toute balise titre et sous titre

                $title = strip_tags($_POST['title']);
                $subtitle = strip_tags($_POST['subtitle']);
                $content = htmlspecialchars($_POST['content']);

                $articleModel = new ArticleManager();
                $articleModel->insert($title, $subtitle,$content);

                $_SESSION['success'] = 'Article ajouté';
                \Http::redirect("index.php?page=management");

            } else {
                $_SESSION['error'] = 'le formulaire est incomplet';

            }
        }

        \Renderer::render('articles/addArticle');
    }

    public function edit()
    {
        //?? conditions au cas ou ya rien
        $id = $_GET["id"] ?? null;
        
        if(!empty($_POST)){
            //post n'est pas vide, je vérifie les données
            if( isset($_POST['title'],$_POST['subtitle'],$_POST['content'],$_POST['id'])
                && !empty($_POST['title']) && !empty($_POST['subtitle']) && !empty($_POST['content']) && !empty($_POST['id'])) {
                //formulaire complet
                //recupère les données
                
                //retire toute balise titre et sous titre
                $id = strip_tags($_POST['id']);
                $title = strip_tags($_POST['title']);
                $subtitle = strip_tags($_POST['subtitle']);

                //neutralise toute balise de contenu
                $content = htmlspecialchars($_POST['content']);
                
                $articleModel = new ArticleManager();
                $articleModel->update($id,$title,$subtitle,$content);

                $_SESSION['success'] = 'Article mis à jour';
                \Http::redirect("index.php?page=management");

            } else {
                $_SESSION['error'] = 'le formulaire est incomplet';
            }
        }
        
        //on vérifie si on a un id
        if ($id == null){
            // je n'ai pas d'id
            \Http::redirect("index.php?page=home");
        }

        $articleModel = new ArticleManager();
        $article = $articleModel->find($id);

        //on vérifie si article est vide
        
        
        if(!$article){
            throw new Exception("cet article n'existe pas");
        }
        

        \Renderer::render('articles/editArticle',[
            'article' => $article
        ]);
    }

    public function back()
    {
        
        /**
         * 2. Récupération des articles
         */
        $articleModel = new ArticleManager();
        $articles = $articleModel->findAll();
        
        /**
         * 3. Affichage
         */
        $pageTitle = "Accueil";
        \Renderer::render('articles/back',compact('pageTitle','articles'));
    }
}