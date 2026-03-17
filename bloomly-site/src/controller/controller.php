<?php

require_once __DIR__ . '/../model/Models.php'; //Charge la classe Upload (gestion de l'enregistrement de fichiers)

use Twig\Loader\FilesystemLoader; //Charge le loader de Twig
use Twig\Environment; //Charge l'environnement de Twig

class TestController
{
    private Environment $twig; // Propriété pour stocker l'environnement Twig

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../templates'); // Indique à Twig où se trouvent les templates
        $this -> twig = new Environment($loader); // Crée une instance de l'environnement Twig
    }

    public function candidature(){
    $message = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';

        if ($action == 'etud'){
            $lettre = htmlspecialchars($_POST['Lettre'] ?? '', ENT_QUOTES, 'UTF-8');

            $upload = new Upload();
            $validation = $upload -> validerFichier($_FILES['cv']);

            if ($validation === true) {
                $nomFichier = $upload->enregistrerFichier($_FILES['cv']);

                if ($nomFichier) {
                    $message = "Candidature envoyée avec succès.<br>";
                    $message .= "CV téléversé : " . htmlspecialchars($nomFichier, ENT_QUOTES, 'UTF-8') . "<br>";
                    $message .= "Lettre de motivation : " . nl2br($lettre);
                } else {
                    $message = "Erreur lors de l'enregistrement du fichier.";
                }
            } else {
                $message = $validation;
            }
        }

        elseif ($action == 'admin_pil'){
        $lettre = htmlspecialchars($_POST['Lettre'] ?? '', ENT_QUOTES, 'UTF-8');

        $message .= "Appréciation : " . nl2br($lettre);
        }
    }
            echo $this -> twig -> render('candidature.twig', // render sert à afficher le template Twig
    // C'est un tableau associatif qui permet de passer des variables au template Twig
        [ 
        'message' => $message // On utilisera : {{ message }}
        ]);
}

    public function liste( array $items, $section){

        $parPage = 9;
        $page = isset($_GET['p']) ? (int) $_GET['p'] : 1;

        $connect = $this -> getConnect();

        $pagination = new Pagination($items, $parPage, $page);

        echo $this -> twig -> render('listes.twig', [
            'itemsPage' => $pagination -> getItemsPage(),
            'page' => $pagination -> getPage(),
            'totalPages' => $pagination -> getTotalPages(),
            'section' => $section,
            'user' => $_GET['user'] ?? '',
            'connect' => $connect
        ]);
    }

    public function choix_section(){
        $section = $_GET['section'] ?? '';

        $entreprises = [
        "NexoraTech",
        "SynaptIQ Solutions",
        "TechVortex",
        "SecureFlow Systems",
        "DataNova",
        "CloudBridge",
        "InnovaDev",
        "OmniTech",
        "Prime Solutions",
        "LogicBloom",
        "CyberNest",
        "CloudHive",
        "HyperNova",
        "IntelliSoft",
        "NextGen Digital",
        "Orbit Systems",
        "SecureMind",
        "TechRoots",
        "VisionCode",
        "WaveLogic",
        "ZenIT",
        "MetaSoft",
        "Digital Horizon"
    ];

    $offres = [
        "Stage Développeur Web - NexoraTech",
        "Stage Data Analyst - SynaptIQ Solutions",
        "Stage Développeur Backend - TechVortex",
        "Stage Cybersécurité - SecureFlow Systems",
        "Stage Data Science - DataNova",
        "Stage Cloud Computing - CloudBridge",
        "Stage Développeur Full Stack - InnovaDev",
        "Stage DevOps - OmniTech",
        "Stage Développeur Java - Prime Solutions",
        "Stage Développeur Frontend - LogicBloom",
        "Stage Sécurité Informatique - CyberNest",
        "Stage Architecte Cloud - CloudHive",
        "Stage Intelligence Artificielle - HyperNova",
        "Stage Développeur Python - IntelliSoft",
        "Stage Développeur Mobile - NextGen Digital",
        "Stage Infrastructure IT - Orbit Systems",
        "Stage Analyste Sécurité - SecureMind",
        "Stage Développeur PHP - TechRoots",
        "Stage Développeur Logiciel - VisionCode",
        "Stage Data Engineer - WaveLogic",
        "Stage Support IT - ZenIT",
        "Stage Développeur Node.js - MetaSoft",
        "Stage Développeur React - Digital Horizon"
    ];

    $etudiants = [
        ["nom" => "Martin", "prenom" => "Lucas"],
        ["nom" => "Nguyen", "prenom" => "Linh"],
        ["nom" => "Diallo", "prenom" => "Aminata"],
        ["nom" => "Garcia", "prenom" => "Carlos"],
        ["nom" => "Kowalski", "prenom" => "Anna"],
        ["nom" => "Benali", "prenom" => "Yassine"],
        ["nom" => "Dubois", "prenom" => "Emma"],
        ["nom" => "Santos", "prenom" => "Mateus"],
        ["nom" => "Kim", "prenom" => "Jisoo"],
        ["nom" => "Rossi", "prenom" => "Giulia"],
        ["nom" => "Haddad", "prenom" => "Nour"],
        ["nom" => "Moreau", "prenom" => "Gabriel"],
        ["nom" => "Singh", "prenom" => "Arjun"],
        ["nom" => "Ivanov", "prenom" => "Dmitri"],
        ["nom" => "Fernandez", "prenom" => "Sofia"],
        ["nom" => "Traoré", "prenom" => "Moussa"],
        ["nom" => "Schmidt", "prenom" => "Lena"],
        ["nom" => "Alvarez", "prenom" => "Diego"],
        ["nom" => "Okafor", "prenom" => "Chinedu"],
        ["nom" => "Tanaka", "prenom" => "Yuki"]
    ];

    $pilots = [
        ["nom" => "Martin", "prenom" => "Lucas"],
        ["nom" => "Nguyen", "prenom" => "Linh"],
        ["nom" => "Diallo", "prenom" => "Aminata"],
        ["nom" => "Garcia", "prenom" => "Carlos"],
        ["nom" => "Kowalski", "prenom" => "Anna"],
        ["nom" => "Benali", "prenom" => "Yassine"],
        ["nom" => "Dubois", "prenom" => "Emma"],
        ["nom" => "Santos", "prenom" => "Mateus"],
        ["nom" => "Kim", "prenom" => "Jisoo"],
        ["nom" => "Rossi", "prenom" => "Giulia"],
        ["nom" => "Haddad", "prenom" => "Nour"],
        ["nom" => "Moreau", "prenom" => "Gabriel"],
        ["nom" => "Singh", "prenom" => "Arjun"],
        ["nom" => "Ivanov", "prenom" => "Dmitri"],
        ["nom" => "Fernandez", "prenom" => "Sofia"],
        ["nom" => "Traoré", "prenom" => "Moussa"],
        ["nom" => "Schmidt", "prenom" => "Lena"],
        ["nom" => "Alvarez", "prenom" => "Diego"],
        ["nom" => "Okafor", "prenom" => "Chinedu"],
        ["nom" => "Tanaka", "prenom" => "Yuki"]
    ];

        if ($section === 'offres') {
            $this -> liste($offres, $section);
            return;
        }
        elseif ($section === 'entreprises') {
            $this -> liste($entreprises, $section);
            return;
        }
        elseif ($section === 'etudiants') {
            $this -> liste($etudiants, $section);
            return;
        }
        elseif ($section === 'pilots') {
            $this -> liste($pilots, $section);
            return;
        }
        elseif ($section === 'wishlist') {
            $this -> liste($offres, $section);
            return;
        }
        else {
            echo "Erreur";
        }
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

    public function a_propos(){
        echo $this -> twig -> render('a_propos.twig');
    }

    public function mentions_legales(){
        echo $this -> twig -> render('mentions_legales.twig');
    }

    public function cookies(){
        echo $this -> twig -> render('cookies.twig');
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

    public function accueil(){
    echo $this -> twig -> render('accueil.twig');
    }

    public function getUser(){

        $id = $_POST['id'] ??'';
        $mdp = $_POST['mdp'] ??'';

        $admin = [
            ["id" => 1, "mdp" => "Alice"],
            ["id" => 2, "mdp" => "Bob"],
            ["id" => 3, "mdp" => "Charlie"]
        ];

        $pilot = [
            ["id" => 4, "mdp" => "David"],
            ["id" => 5, "mdp" => "Emma"],
            ["id" => 6, "mdp" => "Lucas"]
        ];

        $etudiant = [
            ["id" => 7, "mdp" => "Léa"],
            ["id" => 8, "mdp" => "Noah"],
            ["id" => 9, "mdp" => "Inès"]
        ];

        $user = $this -> rechercheUser($id, $mdp, $admin, $pilot, $etudiant);

        return $user;
    }

    public function rechercheUser($id, $mdp, $admin, $pilot, $etudiant){

        foreach ($admin as $user) {
            if ($user['id'] == $id && $user['mdp'] == $mdp) {
                return 1;
            }
        }

        foreach ($pilot as $user) {
            if ($user['id'] == $id && $user['mdp'] == $mdp) {
                return 2;
            }
        }

        foreach ($etudiant as $user) {
            if ($user['id'] == $id && $user['mdp'] == $mdp) {
                return 3;
            }
        }
        return 0;
    }



}
