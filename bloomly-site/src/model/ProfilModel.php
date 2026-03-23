<?php

class ProfileModel
{
    public function getProfile(): array
    {
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