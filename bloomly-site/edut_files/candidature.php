<?php
class Upload {
    private $dossier = "uploads/";
    private $tailleMax = 2097152; // 2 Mo en octets
    private $typesAutorises = ['application/pdf'];
    public function validerFichier($fichier) {
        if (empty($fichier['tmp_name']) || !is_uploaded_file($fichier['tmp_name'])) {
            return "Aucun fichier envoyé.";
        }
        if (!in_array(mime_content_type($fichier['tmp_name']), $this->typesAutorises)) {
            return "Le fichier doit être un PDF.";
        }
        if ($fichier['size'] > $this->tailleMax) {
            return "Le fichier dépasse 2 Mo.";
        }
        return true;
    }
    public function enregistrerFichier($fichier) {
        if (!is_dir($this->dossier)) {
            mkdir($this->dossier);
        }
        $nomFichier = $fichier['name'];
        if (move_uploaded_file($fichier['tmp_name'], $this->dossier . $nomFichier)) {
            return $nomFichier;
        }
        return false;
    }
}
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lettre = htmlspecialchars($_POST['Lettre'] ?? '', ENT_QUOTES, 'UTF-8');
    $upload = new Upload();
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
}
echo($message);
?>