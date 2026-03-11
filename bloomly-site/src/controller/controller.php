<?php

require_once __DIR__ . '/../model/Upload.php'; //Charge la classe Upload (gestion de l'enregistrement de fichiers)

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
        'title' => 'Candidature à une offre', // On utilisera : {{ title }}
        'message' => $message // On utilisera : {{ message }}
    ]);
}

    public function edut_entr(){
        echo $this -> twig-> render('liste_ent.twig', 
        [
            'title' => 'Liste des entreprises'
        ]);
    }
}