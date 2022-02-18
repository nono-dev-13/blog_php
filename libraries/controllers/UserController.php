<?php 

namespace Controllers;

use Exception;
use Models\UserManager;

class UserController extends Controller
{
    protected $modelName = \Models\UserManager::class;

    public function login()
    {
        if(isset($_SESSION["user"])){
            \Http::redirect('index.php?page=management');
        }

        if(!empty($_POST)){
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            
            if(isset($email,$pass) && !empty($email) && !empty($pass) ){
        
                //vérifier si l'email est bien un email
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $_SESSION['error'] = "'adresse email n'est pas bonne";
                }

                $userModel = new UserManager();
                $user = $userModel->getUserByEmail($email);

                //est ce l'email existe dans la bdd
                if(!$user){
                    $_SESSION['error'] = "l'utilisateur et/ou l'email n'existe pas";
                    \Http::redirect('index.php?page=login');
                }

                //on a un user existant, je peux vérif son mot de pass
                if(!password_verify($pass, $user["pass"])){
                    $_SESSION['error'] = "l'utilisateur et/ou l'email n'existe pas";
                    \Http::redirect('index.php?page=login');
                }

                //Ici l'utilisateur et le mot de passe sont corrects
                // on va pouvoir connecter l'utilisateur
                //on va stocker dans $_SESSION les infos de l'utilisateur

                $_SESSION["user"] = [
                    "id"        =>  $user["id"],
                    "pseudo"    =>  $user["username"],
                    "email"     =>  $user["email"],
                    "role"      =>  $user["role"]
                ];
                
                if($user["role"] == 2){
                    //on peut rediriger vers la page de management
                    \Http::redirect('index.php?page=management');
                } else {
                    \Http::redirect('index.php?page=home');
                }
                
            
            } else {
                $_SESSION['error'] = 'Le formulaire est incomplet';
            }
        }
        
        /**
         * 3. Affichage
         */
        $pageTitle = "Connexion";
        \Renderer::render('users/connexion', compact('pageTitle'));
    }

    public function logout()
    {
        if(!isset($_SESSION["user"])){
            \Http::redirect('index.php?page=login');
        }
        //supprime une variable
        unset($_SESSION["user"]);

        \Http::redirect('index.php');
    }

    public function register()
    {
        if(isset($_SESSION["user"])){
            \Http::redirect('index.php?page=management');
        }

        if(!empty($_POST)){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            
            if(isset($username,$email,$pass) && !empty($username) && !empty($email) && !empty($pass) ){
                //le formulaire est complet
                //on récupère les données en les protégeant
                $pseudo = strip_tags($username);
        
                //vérifier si l'email est bien un email
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $_SESSION['error'] = "l'adresse email n'est pas bonne";
                }
        
                //hascher le mot de passe
                $password = password_hash($pass, PASSWORD_ARGON2ID);

                $userModel = new UserManager();
                $id = $userModel->insertUser($pseudo, $email, $password);

                //récupère l'id du nouvel utilisateur
                //$id = $this->model->lastInsertIdUser();
                
                // on connecte l'utilisateur
                $_SESSION["user"] = [
                    "id" => $id,
                    "pseudo" => $pseudo,
                    "email" => $email,
                    "role" => 1
                ];
                
                \Http::redirect('index.php?page=home');
            
            } else {
                $_SESSION['error'] = 'Le formulaire est incomplet';
            }
        }

        /**
         * 3. Affichage
         */
        $pageTitle = "Inscription";
        \Renderer::render('users/inscription',compact('pageTitle'));
    }
}