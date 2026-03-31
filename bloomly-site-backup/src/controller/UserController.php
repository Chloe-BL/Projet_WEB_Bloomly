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
    if (!empty($_POST['id']) && !empty($_POST['mdp'])) {

        $user = $this->userModel->getUserType($_POST['id'], $_POST['mdp']);

        if ($user != 0) {
            $user_actif = $this->userModel->getIdUser($_POST['id'], $_POST['mdp']);

            setcookie("user_id", (string)$user_actif, time() + 3600, "/");

            header("Location: index.php?page=mon_espace&connect=oui&user=" . urlencode($user));
            exit;
        } else {
            echo "Identifiants incorrects";
            exit;
        }
    } else {
        echo "Champs vides";
        exit;
    }
}
    public function mon_espace()
    {

           
    
        $user_actif = $_COOKIE['user_id'] ?? null; // récupère l'id utilisateur depuis le cookie
        $profil = $this -> profileModel -> getProfile($user_actif); // récupère les infos du profil en base

        $this->render('mon_espace.twig', [
            'civilite' => $profil['civilite'],
            'nom' => $profil['nom'],
            'prenom' => $profil['prenom'],
            'telephone' => $profil['telephone'],
            'email' => $profil['email'],
            'identifiant' => $profil['id_utilisateur'],
        ]);
    }
 
    public function inscription()
    {
        $section = $this -> getSection();
        $this->render('inscription.twig', [
            'section' => $section,
        ]);
    }
}
?>