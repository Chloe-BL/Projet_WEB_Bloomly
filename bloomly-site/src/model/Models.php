<?php

class Upload
{
    private string $dossier;
    private int $tailleMax = 2097152; // 2 Mo
    private array $typesAutorises = ['application/pdf'];

    public function __construct(string $dossier = 'uploads/')
    {
        $this->dossier = $dossier;
    }

    public function validerFichier(array $fichier): string|bool
    {
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

    public function enregistrerFichier(array $fichier): string|bool
    {
        if (!is_dir($this->dossier)) {
            mkdir($this->dossier, 0777, true);
        }

        $nomFichier = basename($fichier['name']);
        $cheminFinal = $this->dossier . $nomFichier;

        if (move_uploaded_file($fichier['tmp_name'], $cheminFinal)) {
            return $nomFichier;
        }

        return false;
    }
}

class Pagination 
{
    private array $entreprise;
    private int $parPage;
    private int $page;

    public function __construct(array $entreprise, int $parPage, int $page){
        $this -> entreprise = $entreprise;
        $this -> parPage = $parPage;
        if ($page < 1) {  // Pour ne pas avoir de page négative ou nule
            $page = 1;
        }
        $this -> page = $page;
    }

    public function getTotalEntreprise(){
        return count($this->entreprise);
    }

    public function getTotalPages(){
        return ceil($this -> getTotalEntreprise() / $this -> parPage);
    }

    public function getPage(){
        if ($this -> page > $this -> getTotalPages()) { // Pour ne pas avoir une page supérieure
            $this -> page = $this -> getTotalPages();
        }
        return $this -> page;
    }

    public function getDebut(){
        return ($this -> getPage() - 1) * $this -> parPage;
    }

    public function getEntreprisesPage(){
        return array_slice($this -> entreprise, $this -> getDebut(), $this -> parPage);
    }
}