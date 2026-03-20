<?php 

class CandidatureController
{

    public function __construct(){

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
}