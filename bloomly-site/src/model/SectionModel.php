<?php

require_once __DIR__ . '/BaseModel.php';

class SectionModel extends BaseModel
{
    public function getItemsBySection(string $section) {
 
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
            $sql = "SELECT titre FROM offres";
            $stmt = $this -> pdo -> query($sql);
            $offres = $stmt -> fetchAll();
            return $offres;
        }
 
        if ($section === 'entreprises') {
            $sql = "SELECT nom FROM entreprise";
            $stmt = $this -> pdo -> query($sql);
            $entreprises = $stmt -> fetchAll();
            return $entreprises;
        }
 
        if ($section === 'etudiants') {
            return $etudiants;
        }
 
        if ($section === 'pilots') {
            return $pilots;
        }
 
        if ($section === 'wishlist') {
            return $offres;
        }
 
        if ($section === 'agenda') {
            return $offres;
        }
 
        return null;
    }
}
 