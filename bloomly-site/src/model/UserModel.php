<?php
require_once __DIR__ . '/BaseModel.php';

class UserModel extends BaseModel
{
    public function getUser(string $id, string $mdp)
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
}