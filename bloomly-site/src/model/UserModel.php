<?php
require_once __DIR__ . '/BaseModel.php';

class UserModel extends BaseModel
{
    public function getUserType(string $id, string $mdp) // Récupère le type de l'utilisateur (admin, pilot ou étudiant) en fonction de son identifiant et de son mot de passe
    {
        $sql = "SELECT id_utilisateur, mot_de_passe, id_role FROM utilisateur";
        $stmt = $this -> pdo -> query($sql);
        $utilisateur = $stmt -> fetchAll();
        return $this->rechercheUser($id, $mdp, $utilisateur);
    }

    private function rechercheUser(string $id, string $mdp, array $utilisateur) // Parcourt la liste des utilisateurs pour trouver une correspondance avec l'identifiant et le mot de passe fournis, et retourne le type d'utilisateur
    {
        foreach ($utilisateur as $user) {
            if ($user['id_utilisateur'] == $id && $user['mot_de_passe'] == $mdp &&  $user['id_role'] == 1) {
                return 1;
            }

            elseif($user['id_utilisateur'] == $id && $user['mot_de_passe'] == $mdp &&  $user['id_role'] == 2) {
                return 2;
            }
            
            elseif($user['id_utilisateur'] == $id && $user['mot_de_passe'] == $mdp &&  $user['id_role'] == 3) {
                return 3;
            }

        }
        return 0;
    }

    public function getIdUser(string $id, string $mdp) // Récupère l'id de l'utilisateur en fonction de son identifiant et de son mot de passe
    {
        $sql = "SELECT id_utilisateur FROM utilisateur WHERE id_utilisateur = ? AND mot_de_passe = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id, $mdp]);
        $utilisateur = $stmt->fetch();

        return $utilisateur['id_utilisateur'];
    }
}