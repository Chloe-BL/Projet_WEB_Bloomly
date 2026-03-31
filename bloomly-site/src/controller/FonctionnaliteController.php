<?php

require_once __DIR__ . '/BaseController.php';

use Twig\Environment; //Charge l'environnement de Twig
use Twig\Loader\FilesystemLoader; //Charge le loader de Twig

class FonctionnaliteController extends BaseController
{

    private UserModel $userModel;
    private ProfileModel $profileModel;
    private FonctionnaliteModel $fonctionModel;
    public function __construct()
    
    {
        parent::__construct();

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

     public function description_off()
{
    $id_offre = $_GET['id_offre'] ?? null;

        $offre = $this -> fonctionModel->getOffreById($id_offre);

        echo $this->render('description.twig', [
                           'description' => $offre['description'],
                           'formation' => $offre['formation'],
                           'softskills' => $offre['softskills'],
                           'competence' => $offre['competences'],
                           'date_debut' => $offre['date_debut'],
                           'duree' => $offre['duree'],
                           'lieu' => $offre['lieu'],
                           'salaire' => $offre['salaire'],
                           'date_pub' => $offre['date_pub'],
                           'section' => $_GET['section'] ?? null,
                           'id_offre' =>  $_GET['id_offre'] ?? null,
                           'titre' => $_GET['titre'] ?? null
                            ]);
    }

    public function description_ent()
{
    $id_entreprise = $_GET['id_entreprise'] ?? null;

    if (!$id_entreprise) {
        echo "Entreprise introuvable";
        return;
    }

    $entreprise = $this->fonctionModel->getEntById($id_entreprise);

    if (!$entreprise) {
        echo "Entreprise introuvable";
        return;
    }

    $this->render('description.twig', [
        'description' => $entreprise['description'] ?? '',
        'email' => $entreprise['email_contact'] ?? '',
        'telephone' => $entreprise['telephone_contact'] ?? '',
        'adresse' => $entreprise['adresse'] ?? '',
        'section' => $_GET['section'] ?? null,
        'id_entreprise' => $id_entreprise,
        'nom' => $entreprise['nom'] ?? ''
    ]);
}

     public function description_etu()
    {
        $id_etud = $_GET['id_etud'] ?? null;
 
        $etud = $this -> fonctionModel->getEtudById($id_etud);
 
        echo $this->render('description.twig', [
                           'nom' => $offre['description'],
                           'prenom' => $offre['formation'],
                           'email' => $offre['softskills'],
                           'mdp' => $offre['competences'],
                           'num' => $offre['date_debut'],
                           'civilite' => $offre['duree']
                            ]);
    }

    public function supprimer_off(){
        $id_offre = $_GET['id_offre'] ?? null;
        $section = $this -> getSection();
        $this -> fonctionModel -> SupprimerOff($id_offre);

        header("Location: index.php?page=choix_section&section=" . urlencode($section) . "&connect=oui&user=" . urlencode($user));
        exit;
    }


    public function supprimer_wishlist(){
        $id_offre = $_GET['id_offre'] ?? null;

        $user = $_GET['user'] ?? '';
        $section = $this -> getSection();
        $this -> fonctionModel -> SupprimerWhishlist($id_offre);

        header("Location: index.php?page=choix_section&section=" . urlencode($section) . "&connect=oui&user=" . urlencode($user));
        exit;
    }

    public function supprimer_etudiant(){
        $id_etudiant = $_GET['id_etudiant'] ?? null;

        $user = $_GET['user'] ?? '';
        $section = $this -> getSection();
        $this -> fonctionModel -> SupprimerEtudiant($id_etudiant);

        header("Location: index.php?page=choix_section&section=" . urlencode($section) . "&connect=oui&user=" . urlencode($user));
        exit;
    }

    public function supprimer_pilot(){
        $id_pilote = $_GET['id_pilot'] ?? null;

        $user = $_GET['user'] ?? '';
        $section = $this -> getSection();
        $this -> fonctionModel -> SupprimerPilot($id_pilote);

        header("Location: index.php?page=choix_section&section=" . urlencode($section) . "&connect=oui&user=" . urlencode($user));
        exit;
    }

    public function supprimer_ent(){
        $id_entreprise = $_GET['id_entreprise'] ?? null;
        $section = $this -> getSection();
        $this -> fonctionModel -> SupprimerEnt($id_entreprise);

        header("Location: index.php?page=choix_section&section=" . urlencode($section) . "&connect=oui&user=" . urlencode($user));
        exit;
    }

    public function AddAgenda(){
        $connect = $this->getConnect();
        $user = $this->getUser();
        $section = $this -> getSection();

        $params = $this-> fonctionModel -> ajoutBDDAgenda($_POST['id_offre'], $_POST['titre']);
        
        header("Location: index.php?page=choix_section&section=" . urlencode($section) . "&connect=oui&user=" . urlencode($user));
        exit;
    }


    public function modif_off()
    {
        $section = $this -> getSection();
        $id_offre = $_GET['id_offre'] ?? null;
        $liste_ent = $this->fonctionModel->getAllEntreprises();

        $offre_a_modifier = $this -> fonctionModel -> getOffreById($id_offre);

        $this->render('modifier.twig',[
        'offre'   => $offre_a_modifier,
        'section' => $section,
        'liste_ent' => $liste_ent,
        'user' => $this-> getUser()]);
    }

    public function ValidationModif_off(){

        $connect = $this->getConnect();
        $user = $this->getUser();
        $section = $this -> getSection();
        $id_offre = $_POST['id_offre'] ?? null;

        $params = $this -> fonctionModel -> ModifierOff($_POST['titre'],  
                                                      $_POST['description'], 
                                                      $_POST['formation'], 
                                                      $_POST['softskills'], 
                                                      $_POST['competences'], 
                                                      $_POST['date_debut'], 
                                                      $_POST['duree'], 
                                                      $_POST['lieu'], 
                                                      $_POST['salaire'], 
                                                      $_POST['date_pub'],
                                                      $_POST['ent'],
                                                      $id_offre );

        header("Location: index.php?page=choix_section&section=" . urlencode($section) . "&connect=oui&user=" . urlencode($user));
        exit;
    }

    public function modif_ent()
    {
        $section = $this -> getSection();
        $id_entreprise = $_GET['id_entreprise'] ?? null;
        $liste_ent = $this->fonctionModel->getAllEntreprises();

        $ent_modifier = $this -> fonctionModel -> getEntById($id_entreprise);

        $this->render('modifier.twig',[
        'entreprise'   => $ent_modifier,
        'section' => $section,
        'user' => $this-> getUser()]);
    }

    public function ValidationModif_ent(){

        $connect = $this->getConnect();
        $user = $this->getUser();
        $section = $this -> getSection();
        $id_entreprise = $_POST['id_entreprise'] ?? null;

        $params = $this -> fonctionModel -> ModifierEnt($_POST['nom'], 
                                                      $_POST['description'], 
                                                      $_POST['email_contact'], 
                                                      $_POST['telephone_contact'], 
                                                      $_POST['adresse'],
                                                      $id_entreprise);

        header("Location: index.php?page=choix_section&section=" . urlencode($section) . "&connect=oui&user=" . urlencode($user));
        exit;
    }

    public function ValidationModif_etu(){

    $connect = $this->getConnect();
    $user = $this->getUser();
    $section = $this -> getSection();

    $params = $this -> fonctionModel -> modif_BDD_etudiant($_POST['nom'],  
                                                  $_POST['prenom'], 
                                                  $_POST['email'], 
                                                  $_POST['mdp'], 
                                                  $_POST['num'], 
                                                  $_POST['civilite'], );
       

    header("Location: index.php?page=choix_section&section=" . urlencode($section) . "&connect=oui&user=" . urlencode($user));
    exit;
    }

    public function ValidationModif_pil(){

        $connect = $this->getConnect();
        $user = $this->getUser();
        $section = $this -> getSection();

        $params = $this -> fonctionModel -> modif_BDD_pilote($_POST['nom'],  
                                                      $_POST['prenom'], 
                                                      $_POST['email'], 
                                                      $_POST['mdp'], 
                                                      $_POST['num'], 
                                                      $_POST['civilite'], );
        header("Location: index.php?page=choix_section&section=" . urlencode($section) . "&connect=oui&user=" . urlencode($user));
        exit;
    }

}