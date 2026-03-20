<? php

class AuthController
{
    public function __construct(){

    }

    public function connexion(){
        echo $this -> twig -> render('connexion.twig');
    }

    public function getConnect(){
        $connect = $_GET['connect'];

        if ($connect == 'oui') {
            $connect = true;
        } else {
            $connect = false;
        }
        return $connect;
    }

    public function validationConnexion(){
        $connect = $this -> getConnect();
        
        if (!empty($_POST['id']) && !empty($_POST['mdp'])) { //empty vérifie si les variables sont vides ou inexistantes
            $user = $this -> getUser(); 
        } 
        else {
            $user = $_GET['user']; 
        }


        if ($connect) {
            echo $this -> twig -> render('accueil_user.twig', ['connect' => $connect, 'user' => $user]);
        } 
        else {
            echo "erreur";
        }
        
    }

    public function mon_espace(){
        $user = $_GET['user'];
        $civility = 'Madame';
        $nom = 'Dupont';
        $prenom = 'Jean';
        $telephone = '0123456789';
        $email = 'jean.dupont@example.com';
        $identifiant = 'jean.dupont';
        $connect = $this -> getConnect();

        echo $this -> twig -> render('mon_espace.twig', [
            'user' => $user,
            'civility'=> $civility,
            'nom' => $nom,
            'prenom' => $prenom,
            'telephone' => $telephone,
            'email' => $email,
            'identifiant' => $identifiant,
             'connect' => $connect
        ]);
    }

    public function inscription(){
        $section = $_GET['section'] ?? '';
        $user = $_GET['user'] ?? '';
        $connect = $this -> getConnect();

        echo $this -> twig -> render('inscription.twig' , [
            'section' => $section,
            'connect' => $connect,
            'user' => $user
        ]);
    }
}