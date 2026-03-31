<?php
 
require_once __DIR__ . '/PageController.php'; 

use Twig\Environment; //Charge l'environnement de Twig
use Twig\Loader\FilesystemLoader; //Charge le loader de Twig

class CandidatureController extends BaseController
{
    private $upload;
    private FonctionnaliteModel $fonctionModel;

    public function __construct()
    {
        // on réecrit le constructeur de la classe mère
        $loader = new FilesystemLoader(__DIR__ . '/../templates'); // Indique à Twig où se trouvent les templates
        $this->twig = new Environment($loader);

        // nouveau constructeur
        $this->fonctionModel = new FonctionnaliteModel();
    }

public function setUpload($upload)
{
    $this->upload = $upload;
}

    public function candidature()
    {
        $message = "";
        $user = $_GET['user'] ?? '';
 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
 
            if ($action === 'etud') {
                $lettre = htmlspecialchars($_POST['Lettre'] ?? '', ENT_QUOTES, 'UTF-8');
 
                $upload = $this->upload ?? new Upload();
                $validation = $upload->validerFichier($_FILES['cv']);
 
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
            } elseif ($user === '2' || $user === '1') {
                $lettre = htmlspecialchars($_POST['Lettre'] ?? '', ENT_QUOTES, 'UTF-8');

                $note = isset($_POST['note']) ? (int) $_POST['note'] : 0;
                $idnom = $_POST['id_nom'] ?? null;
                $lettre = $_POST['Lettre'] ?? null;

                $message .= "Appréciation : " . nl2br($lettre) . "<br>";
                $message .= "Note : " . $note . "/4";

                $this -> fonctionModel -> AddEvaluation($lettre, $note, $idnom);
            }
        }
    }
}
 