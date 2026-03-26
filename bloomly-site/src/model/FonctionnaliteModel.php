<?php
require_once __DIR__ . '/BaseModel.php';

class FonctionnaliteModel extends BaseModel 
{
    public function ajout_BDD(string $nom, string $description, string $email_contact, string $telephone_contact, string $adresse){

        $user_actif = $_COOKIE['user_id'] ?? null;
        $section = $_GET['section'] ?? null;

        $sql = "INSERT INTO $section (nom, description, email_contact, telephone_contact, adresse, id_createur) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nom, $description, $email_contact, $telephone_contact, $adresse, $user_actif]);
    }

    public function afficheEntreprise(){
        $user_actif = $_COOKIE['user_id'] ?? null;
        $sql = "SELECT nom FROM entreprises WHERE id_createur = ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_actif]);

        return $stmt->fetchAll();
    }
}
