<?php
 
class AuthController extends BaseController

{

    private UserModel $userModel;

    private ProfileModel $profileModel;
 
    public function __construct()

    {

        parent::__construct();

        $this->userModel = new UserModel();

        $this->profileModel = new ProfileModel();

    }
 
    public function connexion(): void

    {

        $this->render('connexion.twig');

    }
 
    public function validationConnexion(): void

    {

        $connect = $this->getConnect();
 
        if (!empty($_POST['id']) && !empty($_POST['mdp'])) {

            $user = $this->userModel->getUser($_POST['id'], $_POST['mdp']);

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
 
    public function monEspace(): void

    {

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
 
    public function inscription(): void

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