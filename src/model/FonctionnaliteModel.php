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

    if ($type === 'entreprise') {
    $sql = "SELECT nom, description, email_contact, telephone_contact 
            FROM entreprise 
            WHERE nom LIKE :search 
            OR description LIKE :search 
            OR email_contact LIKE :search
            OR telephone_contact LIKE :search";
}

    elseif ($type === 'offre') {
    $sql = "SELECT titre, description, competences, salaire, date_pub 
            FROM offres 
            WHERE titre LIKE :search 
            OR description LIKE :search 
            OR competences LIKE :search
            OR salaire LIKE :search";
}

    elseif ($type === 'etudiant') {
        $sql = "SELECT nom, prenom, email 
                FROM utilisateur 
                WHERE id_role = 3 
                AND (nom LIKE :search OR prenom LIKE :search OR email LIKE :search)";
    }

    elseif ($type === 'pilote') {
        $sql = "SELECT nom, prenom 
                FROM utilisateur 
                WHERE id_role = 2 
                AND (nom LIKE :search OR prenom LIKE :search)";
    }

    elseif ($type === 'all') {
        $sql = "
            SELECT nom AS titre, description AS info, 'entreprise' AS type_result 
            FROM entreprise 
            WHERE nom LIKE :search 
            OR description LIKE :search 
            OR email_contact LIKE :search

            UNION

            SELECT titre AS titre, description AS info, 'offre' AS type_result 
            FROM offres 
            WHERE titre LIKE :search 
            OR description LIKE :search 
            OR competences LIKE :search

            UNION

            SELECT CONCAT(nom, ' ', prenom) AS titre, email AS info, 'etudiant' AS type_result 
            FROM utilisateur WHERE id_role = 3 
            AND (nom LIKE :search OR prenom LIKE :search)

            UNION

            SELECT CONCAT(nom, ' ', prenom) AS titre, email AS info, 'pilote' AS type_result 
            FROM utilisateur WHERE id_role = 2 
            AND (nom LIKE :search OR prenom LIKE :search)
        ";
    }

    else {
        return [];
    }

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['search' => $search]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
};