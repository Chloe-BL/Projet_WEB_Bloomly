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
    public function ajout_ent()
    {
        $section = $this->getSection();
        
        $this->render('ajout.twig', [
            'section' => $section]);
    }

    public function ValidationAjout_ent(){

        $connect = $this->getConnect();
        $user = $this->getUser();
        $section = $this -> getSection();

        $params = $this -> fonctionModel -> ajout_BDD_ent($_POST['nom'], 
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

    public function ajout_off()
    {
        $section = $this -> getSection();
        $liste_ent = $this->fonctionModel->getAllEntreprises();

        $this->render('ajout.twig',[
        'section' => $section,
        'liste_ent' => $liste_ent]);
    }

    public function ValidationAjout_off(){

        $connect = $this->getConnect();
        $user = $this->getUser();
        $section = $this -> getSection();

        $params = $this -> fonctionModel -> ajout_BDD_off($_POST['titre'],  
                                                      $_POST['description'], 
                                                      $_POST['formation'], 
                                                      $_POST['softskills'], 
                                                      $_POST['competence'], 
                                                      $_POST['date_debut'], 
                                                      $_POST['duree'], 
                                                      $_POST['lieu'], 
                                                      $_POST['salaire'], 
                                                      $_POST['date_pub'],
                                                      $_POST['ent']);

        header("Location: index.php?page=choix_section&section=" . urlencode($section) . "&connect=oui&user=" . urlencode($user));
        exit;
    }

    public function ValidationAjout_etudiant(){

        $connect = $this->getConnect();
        $user = $this->getUser();
        $section = $this -> getSection();

        $params = $this -> fonctionModel -> ajout_BDD_etudiant($_POST['nom'],  
                                                      $_POST['prenom'], 
                                                      $_POST['email'], 
                                                      $_POST['mdp'], 
                                                      $_POST['num'], 
                                                      $_POST['civilite'], );
       

        header("Location: index.php?page=choix_section&section=" . urlencode($section) . "&connect=oui&user=" . urlencode($user));
        exit;
    }

    public function ValidationAjout_pilote(){

        $connect = $this->getConnect();
        $user = $this->getUser();
        $section = $this -> getSection();

        $params = $this -> fonctionModel -> ajout_BDD_pilote($_POST['nom'],  
                                                      $_POST['prenom'], 
                                                      $_POST['email'], 
                                                      $_POST['mdp'], 
                                                      $_POST['num'], 
                                                      $_POST['civilite'], );
        header("Location: index.php?page=choix_section&section=" . urlencode($section) . "&connect=oui&user=" . urlencode($user));
        exit;
    }

    public function AddFavoris(){
        
        $connect = $this->getConnect();
        $user = $this->getUser();
        $section = $this -> getSection();

        $params = $this-> fonctionModel -> ajoutBDDWishlist($_POST['id_offre'], $_POST['titre']);
        
        header("Location: index.php?page=choix_section&section=" . urlencode($section) . "&connect=oui&user=" . urlencode($user));
        exit;
    }

}