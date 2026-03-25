<?php

use Twig\Environment; //Charge l'environnement de Twig
use Twig\Loader\FilesystemLoader; //Charge le loader de Twig

class UserController extends BaseController

{
    protected Environment $twig;
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
 
    public function connexion()
    {
        $this->render('connexion.twig');
    }
 
    public function validationConnexion()
    {
        $connect = $this->getConnect();
        if (!empty($_POST['id']) && !empty($_POST['mdp'])) {
            $user = $this -> userModel -> getUserType($_POST['id'], $_POST['mdp']);
        } else {
            $user = getUser();
        }

        if ($connect) {
            $this->render('accueil_user.twig');

        } else {
            echo "erreur";
        }
    }
 
    public function mon_espace()
    {
        $profil = $this -> profileModel -> getProfile();
        $this->render('mon_espace.twig', [
            'civility' => $profil['civility'],
            'nom' => $profil['nom'],
            'prenom' => $profil['prenom'],
            'telephone' => $profil['telephone'],
            'email' => $profil['email'],
            'identifiant' => $profil['identifiant'],
        ]);
    }
 
    public function inscription()
    {
        $section = getSection();
        $this->render('inscription.twig', [
            'section' => $section,
        ]);
    }
}
?>