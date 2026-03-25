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
}