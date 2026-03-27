<?php

require_once __DIR__ . '/BaseModel.php';

class SectionModel extends BaseModel
{
    public function getItemsBySection(string $section) {
 
 
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
            $user_actif = $_COOKIE['user_id'] ?? null;
            $sql = "SELECT titre FROM offres WHERE id_createur = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$user_actif]);
            $offres = $stmt -> fetchAll();
            return $offres;
        }
 
        if ($section === 'entreprises') {
            $user_actif = $_COOKIE['user_id'] ?? null;
            $sql = "SELECT nom FROM entreprises WHERE id_createur = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$user_actif]);
            $entreprises = $stmt -> fetchAll();
            return $entreprises;
        }
 
        if ($section === 'etudiants') {
            $user_actif = $_COOKIE['user_id'] ?? null;
            $sql = "SELECT nom, prenom FROM utilisateur WHERE id_createur = ? && id_role = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$user_actif, 3]);
            $etudiants = $stmt -> fetchAll();
            return $etudiants;
        }
 
        if ($section === 'pilots') {
            return $pilots;
        }
 
        if ($section === 'wishlist') {
            $sql = "SELECT titre FROM offres";
            $stmt = $this -> pdo -> query($sql);
            $offres = $stmt -> fetchAll();
            return $offres;
        }
 
        if ($section === 'agenda') {
            $sql = "SELECT titre FROM offres";
            $stmt = $this -> pdo -> query($sql);
            $offres = $stmt -> fetchAll();
            return $offres;
        }
 
        return null;
    }
}
 