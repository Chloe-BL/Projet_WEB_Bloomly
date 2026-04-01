<?php
require_once __DIR__ . '/BaseModel.php';

class ProfileModel extends BaseModel
{
    public function getProfile($user_actif)
    {
        $sql = "SELECT prenom, nom, email, telephone, civilite, id_utilisateur
                FROM utilisateur
                WHERE id_utilisateur = ?";

        $stmt = $this->pdo->prepare($sql); // Prépare la requête sécurisée
        $stmt -> execute([$user_actif]); // Injecte l'id utilisateur dans la requête

        return $stmt->fetch();
    }

    public function getPrenom($id, $mdp)
    {
        $sql = "SELECT prenom FROM utilisateur WHERE id_utilisateur = ? AND mot_de_passe = ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id, $mdp]);

        return $stmt->fetchColumn();
    }
}