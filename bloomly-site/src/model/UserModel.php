<?php

class UserModel
{
    public function getUser(string $id, string $mdp): int
    {
        $admin = [
            ["id" => 1, "mdp" => "Alice"],
            ["id" => 2, "mdp" => "Bob"],
            ["id" => 3, "mdp" => "Charlie"]
        ];

        $pilot = [
            ["id" => 4, "mdp" => "David"],
            ["id" => 5, "mdp" => "Emma"],
            ["id" => 6, "mdp" => "Lucas"]
        ];

        $etudiant = [
            ["id" => 7, "mdp" => "Léa"],
            ["id" => 8, "mdp" => "Noah"],
            ["id" => 9, "mdp" => "Inès"]
        ];

        return $this->rechercheUser($id, $mdp, $admin, $pilot, $etudiant);
    }

    private function rechercheUser(string $id, string $mdp, array $admin, array $pilot, array $etudiant): int
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