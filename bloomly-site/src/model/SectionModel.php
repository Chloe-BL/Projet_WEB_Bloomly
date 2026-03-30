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
            $sql = "SELECT id, titre FROM offres WHERE id_createur = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$user_actif]);
            $offres = $stmt -> fetchAll();
            return $offres;
        }
 
        if ($section === 'entreprises') {
            $user_actif = $_COOKIE['user_id'] ?? null;
            $sql = "SELECT * FROM entreprises WHERE id_createur = ?";
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
            $user_actif = $_COOKIE['user_id'] ?? null;
            $sql = "SELECT nom, prenom FROM utilisateur WHERE id_createur = ? && id_role = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$user_actif, 2]);
            $pilots = $stmt -> fetchAll();
            return $pilots;
        }
 
        if ($section === 'wishlist') {
            $user_actif = $_COOKIE['user_id'] ?? null;
            $sql = "SELECT * FROM wishlist WHERE id_utilisateur = ?";
            $stmt = $this -> pdo -> prepare($sql);
            $stmt->execute([$user_actif]);
            $offres = $stmt -> fetchAll();
            return $offres;
        }
 
        if ($section === 'agenda') {
            $user_actif = $_COOKIE['user_id'] ?? null;

            $sql = "SELECT o.* FROM offres o 
                    INNER JOIN agenda a ON o.id = a.id_offre 
                    WHERE a.id_utilisateur = ?";
            $stmt = $this -> pdo -> prepare($sql);
            $stmt->execute([$user_actif]); 
            $offres = $stmt -> fetchAll();
            return $offres;
        }
 
        return null;
    }
}
 