<?php

require_once __DIR__ . '/BaseModel.php';

class SectionModel extends BaseModel
{
    public function getItemsBySection(string $section) {
 
        if ($section === 'offres') {
            $user_actif = $_COOKIE['user_id'] ?? null;
            $user = $_GET['user'] ?? null;

            if ($user === '3') {
                $sql = "SELECT id, titre FROM offres";
                $stmt = $this->pdo->query($sql);
                $offres = $stmt -> fetchAll();
            }

            else {
                $sql = "SELECT id, titre FROM offres WHERE id_createur = ?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$user_actif]);
                $offres = $stmt -> fetchAll();
            }
            return $offres;
        }
    
 
        if ($section === 'entreprises') {
            $user_actif = $_COOKIE['user_id'] ?? null;
            $user = $_GET['user'] ?? null;

            if ($user === '3') {
                $sql = "SELECT id_entreprise, nom FROM entreprises";
                $stmt = $this->pdo->query($sql);
                $entreprises = $stmt -> fetchAll();
            }

            else {
                $sql = "SELECT id_entreprise, nom FROM entreprises WHERE id_createur = ?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$user_actif]);
                $entreprises = $stmt -> fetchAll();
            }

            return $entreprises;
        }
 
        if ($section === 'etudiants') {
            $user_actif = $_COOKIE['user_id'] ?? null;
            $sql = "SELECT * FROM utilisateur WHERE id_createur = ? && id_role = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$user_actif, 3]);
            $etudiants = $stmt -> fetchAll();
            return $etudiants;
        }
 
        if ($section === 'pilots') {
            $user_actif = $_COOKIE['user_id'] ?? null;
            $sql = "SELECT * FROM utilisateur WHERE id_createur = ? && id_role = ?";
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
            $user = $_GET['user'] ?? null;     

            if ($user === '3'){
            $user_actif = $_COOKIE['user_id'] ?? null;

            $sql = "SELECT * FROM agenda WHERE id_utilisateur = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$user_actif]);

            $agenda = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $agenda;
            }

            else {
            $etu = $_GET['id_etud'] ?? null;
            $sql = "SELECT o.* FROM offres o 
                    INNER JOIN agenda a ON o.id = a.id_offre 
                    WHERE a.id_utilisateur = ?";
            $stmt = $this -> pdo -> prepare($sql);
            $stmt->execute([$etu]); 
            $offres = $stmt -> fetchAll();
            return $offres;

            }

        }
 
        return null;
    }
}
 