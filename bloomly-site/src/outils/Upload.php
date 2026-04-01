<?php

class Upload
{
    private string $dossier;
    private int $tailleMax = 2097152; // 2 Mo
    private array $typesAutorises = ['application/pdf'];

    public function __construct(string $dossier = __DIR__ . '/../../uploads/')
    {
        $this->dossier = $dossier;
    }

    public function validerFichier(array $fichier): string|bool
    {
        if (empty($fichier['tmp_name']) || !is_uploaded_file($fichier['tmp_name'])) { // Vérifie si un fichier a été envoyé
            return "Aucun fichier envoyé.";
        }

        if (!in_array(mime_content_type($fichier['tmp_name']), $this->typesAutorises)) { // Vérifie si le fichier est un PDF
            return "Le fichier doit être un PDF.";
        }

        if ($fichier['size'] > $this->tailleMax) { 
            return "Le fichier dépasse 2 Mo.";
        }

        return true;
    }

    public function enregistrerFichier(array $fichier): string|bool // Enregistre le fichier dans le dossier spécifié et retourne le nom du fichier ou false en cas d'erreur
    {
        if (!is_dir($this->dossier)) {
            mkdir($this->dossier, 0777, true);
        }

        $extension = pathinfo($fichier['name'], PATHINFO_EXTENSION);
        $nomFichier = uniqid('cv_', true) . '.' . $extension;
        $cheminFinal = $this->dossier . $nomFichier;

        if (move_uploaded_file($fichier['tmp_name'], $cheminFinal)) {
            return $nomFichier;
        }

        return false;
    }
}
?>