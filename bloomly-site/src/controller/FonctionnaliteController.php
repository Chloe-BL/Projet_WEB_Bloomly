<?php

use Twig\Environment; //Charge l'environnement de Twig
use Twig\Loader\FilesystemLoader; //Charge le loader de Twig

class FonctionnaliteController extends BaseController
{

    private UserModel $userModel;
    private ProfileModel $profileModel;
    private FonctionnaliteModel $fonctionModel;
    public function __construct()
    
    {
        // on réecrit le constructeur de la classe mère
        $loader = new FilesystemLoader(__DIR__ . '/../templates'); // Indique à Twig où se trouvent les templates
        $this->twig = new Environment($loader);

        // nouveau constructeur
        $this->userModel = new UserModel();
        $this->profileModel = new ProfileModel();
        $this->fonctionModel = new FonctionnaliteModel();
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
        $user = $this->getUser();
        $section = $this -> getSection();

        $params = $this -> fonctionModel -> ajout_BDD($_POST['nom'], 
                                                      $_POST['description'], 
                                                      $_POST['email_contact'], 
                                                      $_POST['telephone_contact'], 
                                                      $_POST['adresse']);
        if ($connect) {
            $this->render('listes.twig', ['section' => $section ]);
        } 
        else {
            echo "erreur";
        }

        header("Location: index.php?page=choix_section&section=" . urlencode($section) . "&connect=oui&user=" . urlencode($user));

            exit;
    }

}