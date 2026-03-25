<?php

class UserModel 
{
    public function getUser(string $id, string $mdp)
    {
        
        return $this->rechercheUser($id, $mdp, $utilisateur);
    }

    private function rechercheUser(string $id, string $mdp, array $admin, array $pilot, array $etudiant)
    {
        foreach ($admin as $user) {
            if ($user['id'] == $id && $user['mdp'] == $mdp) {
                return 1;
            }
        }

        foreach ($pilot as $user) {
            if ($user['id'] == $id && $user['mdp'] == $mdp) {
                return 2;
            }
        }

        foreach ($etudiant as $user) {
            if ($user['id'] == $id && $user['mdp'] == $mdp) {
                return 3;
            }
        }

        return 0;
    }
}