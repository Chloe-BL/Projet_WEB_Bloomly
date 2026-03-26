<?php

use Twig\Environment; //Charge l'environnement de Twig
use Twig\Loader\FilesystemLoader; //Charge le loader de Twig

class FonctionnaliteController extends BaseController
{

    private UserModel $userModel;
    private ProfileModel $profileModel;
    public function __construct()
    
    {
        // on réecrit le constructeur de la classe mère
        $loader = new FilesystemLoader(__DIR__ . '/../templates'); // Indique à Twig où se trouvent les templates
        $this->twig = new Environment($loader);

        // nouveau constructeur
        $this->userModel = new UserModel();
        $this->profileModel = new ProfileModel();
    }
    public function ajout()
    {
        $section = $this -> getSection();

        $this->render('ajout.twig',[
        'section' => $section
        ]);
    }

    public function ValidationAjout(){

        $connect = $this->getConnect();
        $section = $this -> getSection();
        $user_actif = $_COOKIE['user_id'] ?? null;

        $params = $this -> userModel -> ajout_BDD($_POST['id_entreprise'], 
                                                  $_POST['nom'], 
                                                  $_POST['description'], 
                                                  $_POST['email_contact'], 
                                                  $_POST['telephone_contact'], 
                                                  $_POST['adresse'], $user_actif);
        if ($connect) {
            $this->render('listes.twig', ['section' => $section ]);
        } 
        else {
            echo "erreur";
        }
    }

}