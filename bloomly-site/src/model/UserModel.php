<?php
require_once __DIR__ . '/BaseModel.php';

class UserModel extends BaseModel
{
    public function getUserType(string $id, string $mdp)
    {
        $sql = "SELECT id_utilisateur, mot_de_passe, id_role FROM utilisateur";
        $stmt = $this -> pdo -> query($sql);
        $utilisateur = $stmt -> fetchAll();
        return $this->rechercheUser($id, $mdp, $utilisateur);
    }

    private function rechercheUser(string $id, string $mdp, array $utilisateur)
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

    public function getIdUser(string $id, string $mdp)
    {
        $sql = "SELECT id_utilisateur FROM utilisateur WHERE id_utilisateur = $id AND mot_de_passe = $mdp";
        $stmt = $this -> pdo -> prepare($sql);
        $stmt ->execute([$id, $mdp]);
        $utilisateur = $stmt -> fetch();
        return $utilisateur['id'];
    }

    public function Cookie()
    {
        $user_actif = getIdUser($_POST['id'], $_POST['mdp']);
        setcookie("user_id", $user_actif, time()+3600, "/");
        header("Location : index.php?page=connexion&connect=non");
        exit;
    }