<?php 

namespace Controllers;

class ContactController extends Controller
{
    protected $modelName = \Models\ContactManager::class;
    
    public function acceuilContact()
    {
        //formulaire pour poster un commentaire
        if (!empty($_POST)) {
            //post n'est pas vide, je vérifie les données
            if (isset($_POST["name"], $_POST["email"], $_POST["subject"], $_POST["message"])
                && !empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["subject"]) && !empty($_POST["message"])) {

                $name = strip_tags($_POST["name"]);
                $email = $_POST["email"];

                if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $_SESSION['error'] = "l'email email n'est pas bonne";
                }

                $subject = strip_tags($_POST["subject"]);
                $message = htmlspecialchars($_POST["message"]);

                $this->model->postContact($name,$email,$subject,$message);

                $toEmail = "arnaud.boubli19@gmail.com";
                $mailHeaders = "From: " . $name . "<" . $email . ">\r\n";
                if (mail($toEmail, $subject, $message, $mailHeaders)) {
                    $_SESSION['success'] = "Vos informations de contact ont été reçues avec succès.";
                } else {
                    $_SESSION['error'] = "Erreur lors de l'envoi de l'e-mail.";
                }

            } else {
                $_SESSION['error'] = 'le formulaire est incomplet';
            }
        }

        /**
         * 2. Affichage
         */
        $pageTitle = "Accueil";
        \Renderer::render('accueil',compact('pageTitle'));
    }
}