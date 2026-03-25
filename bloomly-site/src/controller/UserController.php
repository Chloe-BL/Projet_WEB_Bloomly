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
            $user = $this -> userModel -> getUser($_POST['id'], $_POST['mdp']);
        } else {
            $user = $_GET['user'] ?? 0;
        }

        if ($connect) {
            $this->render('accueil_user.twig', [
                'connect' => $connect,
                'user' => $user
            ]);

        } else {
            echo "erreur";
        }
    }
 
    public function mon_espace()
    {
        $sql = "SELECT id_utilisateur, mot_de_passe, id_role FROM utilisateur";
        $stmt = $this -> pdo -> query($sql);
        $utilisateur = $stmt -> fetchAll();
        return $this->rechercheUser($id, $mdp, $utilisateur);
        
        $user = $_GET['user'] ?? '';
        $profil = $this->profileModel->getProfile();
        $this->render('mon_espace.twig', [
            'user' => $user,
            'civility' => $profil['civility'],
            'nom' => $profil['nom'],
            'prenom' => $profil['prenom'],
            'telephone' => $profil['telephone'],
            'email' => $profil['email'],
            'identifiant' => $profil['identifiant'],
            'connect' => $this->getConnect()
        ]);
    }
 
    public function inscription()
    {
        $section = $_GET['section'] ?? '';
        $user = $_GET['user'] ?? '';
        $connect = $this->getConnect();
        $this->render('inscription.twig', [
            'section' => $section,
            'user' => $user,
            'connect' => $connect
        ]);
    }
}
?>