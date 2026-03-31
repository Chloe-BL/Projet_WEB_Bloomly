<?php
 
 
class CandidatureController extends BaseController
{
    private $upload;

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
            } elseif ($action === 'admin_pil') {
                $lettre = htmlspecialchars($_POST['Lettre'] ?? '', ENT_QUOTES, 'UTF-8');
                $message .= "Appréciation : " . nl2br($lettre);
            }
        }
 
        if ()
    }
}