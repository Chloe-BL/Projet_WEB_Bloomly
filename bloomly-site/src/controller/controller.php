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

    public function edut_entr(){
        $entreprises = ["NexoraTech",
            "SynaptIQ Solutions",
            "TechVortex",
            "SecureFlow Systems",
            "DataNova",
            "CloudBridge",
            "InnovaDev",
            "CyberSphere",
            "SoftWave",
            "FutureLabs",
            "AlphaCode",
            "BlueMatrix",
            "Quantum IT",
            "NetFusion",
            "DevSpark",
            "InfoPulse",
            "SkyWare",
            "HexaDigital",
            "CodeFactory",
            "BrightSystems",
            "NovaLink",
            "SmartCore",
            "ByteWorks",
            "GreenSoft",
            "InfraTech",
            "OptimaWeb",
            "DataCraft",
            "PixelForge",
            "Visionary Tech",
            "Proxima Dev",
            "Sigma Networks",
            "AeroCode",
            "Delta Systems",
            "Fusion Labs",
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
            "Digital Horizon"];

        $parPage = 9;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        $pagination = new Pagination($entreprises, $parPage, $page);

        echo $this -> twig -> render('annonces.twig', [
            'entreprisesPage' => $pagination -> getItemsForPage(),
            'page' => $pagination -> getPage(),
            'totalPages' => $pagination -> getTotalPages()
        ]);
    }
}