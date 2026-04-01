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

        if (!empty($_POST['id']) && !empty($_POST['mdp'])) { // Vérifie que les champs d'identifiant et de mot de passe ne sont pas vides
            $user = $this->userModel->getUserType($_POST['id'], $_POST['mdp']);
            $prenom = $this->profileModel->getPrenom($_POST['id'], $_POST['mdp']);

            if ($connect) {
                $user_actif = $this->userModel->getIdUser($_POST['id'], $_POST['mdp']); // Récupère l'id de l'utilisateur à partir du modèle
                setcookie("user_id", $user_actif, time() + 3600, "/"); // stocke l'id dans un cookie (1h)
                setcookie("prenom", $prenom, time() + 3600, "/");
            }
        } 
        else {
            $user = $this -> getUser();
            $prenom = $_COOKIE['prenom'] ?? '';
        }

        if ($connect) {
            $this->render('accueil_user.twig', ['user' => $user , 'prenom' => $prenom]);
        } 
        else {
            echo "erreur";
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