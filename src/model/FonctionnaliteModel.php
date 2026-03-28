<?php
require_once __DIR__ . '/BaseModel.php';

class FonctionnaliteModel extends BaseModel 
{
    public function ajout_BDD_ent(string $nom, string $description, string $email_contact, string $telephone_contact, string $adresse){

        $user_actif = $_COOKIE['user_id'] ?? null;
        $section = $_GET['section'] ?? null;

        $sql = "INSERT INTO $section (nom, description, email_contact, telephone_contact, adresse, id_createur) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nom, $description, $email_contact, $telephone_contact, $adresse, $user_actif]);
    }

    public function ajout_BDD_off(string $titre, string $description, string $formation, string $softskills, string $competences, string $date_debut, string $duree, string $lieu, string $salaire, string $date_pub){

    $user_actif = $_COOKIE['user_id'] ?? null;
    $section = $_GET['section'] ?? null;

    $sql = "INSERT INTO $section (titre, description, formation, softskills, competences, date_debut, duree, lieu, salaire, date_pub, id_createur) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([$titre, $description, $formation, $softskills, $competences, $date_debut, $duree, $lieu, $salaire, $date_pub, $user_actif]);
    }

    public function ajout_BDD_etudiant(string $nom, string $prenom, string $email, string $mot_de_passe, string $telephone, string $civilite){
        $user_actif = $_COOKIE['user_id'] ?? null;
        $section = 'utilisateur';

        $sql = "INSERT INTO $section (nom, prenom, email, mot_de_passe, telephone, civilite, id_role, id_createur) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nom, $prenom, $email, $mot_de_passe, $telephone, $civilite, 3, $user_actif]);
    }

    public function ajout_BDD_pilote(string $nom, string $prenom, string $email, string $mot_de_passe, string $telephone, string $civilite){
        $user_actif = $_COOKIE['user_id'] ?? null;

        $sql = "INSERT INTO utilisateur (nom, prenom, email, mot_de_passe, telephone, civilite, id_role, id_createur) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nom, $prenom, $email, $mot_de_passe, $telephone, $civilite, 2, $user_actif]);
    }
    public function searchGlobal($search, $type)
    {
    $search = "%$search%";

    if ($type === 'all') {
        $sql = "
            SELECT nom AS titre, email AS info FROM utilisateur
            WHERE nom LIKE :search OR prenom LIKE :search

            UNION

            SELECT nom AS titre, email_contact AS info FROM entreprise
            WHERE nom LIKE :search

            UNION

            SELECT titre AS titre, description AS info FROM offre
            WHERE titre LIKE :search
        ";
    }

    elseif ($type === 'etudiant') {
        $sql = "SELECT nom AS titre, email AS info FROM utilisateur 
                WHERE nom LIKE :search OR prenom LIKE :search";
    }

    elseif ($type === 'entreprise') {
        $sql = "SELECT nom AS titre, email_contact AS info FROM entreprise 
                WHERE nom LIKE :search";
    }

    elseif ($type === 'offre') {
        $sql = "SELECT titre AS titre, description AS info FROM offre 
                WHERE titre LIKE :search";
    }

    else {
        return [];
    }

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        'search' => $search
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
};