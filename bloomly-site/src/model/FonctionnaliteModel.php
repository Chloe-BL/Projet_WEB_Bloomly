<?php

class FonctionnaliteModel{
    public function ajout_BDD(){
        $user_actif = $_COOKIE['user_id'] ?? null;
        $sql = "INSERT INTO $section (id_entreprise, nom, description, email_contact, telephone_contact, adresse, id_createur) VALUES ( id_entreprise = ?, nom = ?, descriptionn= ?, email_contact = ?, telephone_contact = ?, adresse = ?, id_utilisateur = ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_entreprise, $nom, $description, $email_contact, $telephone_contact, $adresse, $user_actif]);
        $utilisateur = $stmt->fetch();
}
}
