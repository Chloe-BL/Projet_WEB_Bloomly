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

    echo $this -> twig -> render('candidature.twig', // render sert à afficher le template Twig
    // C'est un tableau associatif qui permet de passer des variables au template Twig
    [ 
        'message' => $message // On utilisera : {{ message }}
    ]);
}

    public function liste( array $items, $section){

        $parPage = 9;
        $page = isset($_GET['p']) ? (int) $_GET['p'] : 1;

        $pagination = new Pagination($items, $parPage, $page);

        echo $this -> twig -> render('listes.twig', [
            'itemsPage' => $pagination -> getItemsPage(),
            'page' => $pagination -> getPage(),
            'totalPages' => $pagination -> getTotalPages(),
            'section' => $section
        ]);
    }

    public function accueil_user(){
        $user = 'etudiant';
        echo $this -> twig -> render('accueil_user.twig', [ 'user' => $user ]);
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

        if ($section === 'offres') {
            $this -> liste($offres, $section);
            return;
        }
        elseif ($section === 'entreprises') {
            $this -> liste($entreprises, $section);
            return;
        }
        else {
            echo "Erreur";
        }
    }

    public function connexion(){
        echo $this -> twig -> render('connexion.twig');
    }

}