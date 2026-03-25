<?php

class ProfileModel
{
    public function getProfile()
    {
        $sql = "SELECT prenom, nom, email, mot_de_passe, telephone, civilite FROM utilisateur WHERE id_utilisateur = $user_actif";
        $stmt = $this -> pdo -> query($sql);
        $utilisateur = $stmt -> fetchAll();
        return $this->rechercheUser($id, $mdp, $utilisateur);
        return [
            'civility' => 'Madame',
            'nom' => 'Dupont',
            'prenom' => 'Jean',
            'telephone' => '0123456789',
            'email' => 'jean.dupont@example.com',
            'identifiant' => 'jean.dupont'
        ];
    }
}