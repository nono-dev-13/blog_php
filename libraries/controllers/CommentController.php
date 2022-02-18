<?php 

namespace Controllers;

use Models\ArticleManager;
use Models\CommentManager;

class CommentController
{
    protected $modelName = \Models\CommentManager::class;
    
    
    public function save()
    {
        /**
         * 1. On vérifie que les données ont bien été envoyées en POST
         * D'abord, on récupère les informations à partir du POST
         * Ensuite, on vérifie qu'elles ne sont pas nulles
         */
        // On commence par l'author
        $author = null;
        if (!empty($_POST['author'])) {
            $author = strip_tags($_POST['author']);
        }

        // Ensuite le contenu
        $content = null;
        if (!empty($_POST['content'])) {
            // On fait quand même gaffe à ce que le gars n'essaye pas des balises cheloues dans son commentaire
            $content = htmlspecialchars($_POST['content']);
        }

        // Enfin l'id de l'article
        $article_id = null;
        if (!empty($_POST['article_id']) && ctype_digit($_POST['article_id'])) {
            $article_id = strip_tags($_POST['article_id']);
        }

        // Vérification finale des infos envoyées dans le formulaire (donc dans le POST)
        // Si il n'y a pas d'auteur OU qu'il n'y a pas de contenu OU qu'il n'y a pas d'identifiant d'article
        if (!$author || !$article_id || !$content) {
            $_SESSION['error']="Votre formulaire a été mal rempli !";
        } else {

            $articleModel = new ArticleManager();
            $article = $articleModel->find($article_id);
            
            // Si rien n'est revenu, on fait une erreur
            if (!$article) {
                $_SESSION['error']= "Ho ! L'article $article_id n'existe pas boloss !";
            }

            // 3. Insertion du commentaire
            $commentModel = new CommentManager();
            $commentModel->insert($author, $content, $article_id);

            $_SESSION['success']= "Votre commentaire à bien été pris en compte, en cours de validation";
        }
        // 4. Redirection vers l'article en question :

        \Http::redirect('index.php?page=article&id=' . $article_id);
    }

    public function delete()
    {
        /**
         * 1. Récupération du paramètre "id" en GET
         */
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            $_SESSION['error'] = "Ho ! Fallait préciser le paramètre id en GET !";
        }

        $id = $_GET['id'];

        /**
         * 3. Vérification de l'existence du commentaire
         */
        $commentModel = new CommentManager();
        $commentaire = $commentModel->find($id);
        if (!$commentaire) {
            $_SESSION['error']="Aucun commentaire n'a l'identifiant $id !";
        }

        /**
         * 4. Suppression réelle du commentaire
         * On récupère l'identifiant de l'article avant de supprimer le commentaire
         */
        $article_id = $commentaire['article_id'];
        
        $commentModel->delete($id);

        /**
         * 5. Redirection vers l'article en question
         */

        \Http::redirect("index.php?page=article&id=" . $article_id);
    }

    public function validation()
    {
        //?? conditions au cas ou ya rien
        $id = $_GET["id"] ?? null;

        $commentModel = new CommentManager();
        $commentModel->updateValidation($id,COMMENTAIRE_VALID);

        $_SESSION['success'] = 'commentaire accepté';
        \Http::redirect("index.php?page=management");
    }

    public function reject()
    {
        //?? conditions au cas ou ya rien
        $id = $_GET["id"] ?? null;

        $commentModel = new CommentManager();
        $commentModel->updateValidation($id,COMMENTAIRE_INVALID);

        $_SESSION['success'] = 'commentaire refusé';
        \Http::redirect("index.php?page=management");
    }
}