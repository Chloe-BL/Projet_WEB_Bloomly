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

    public function ajout_BDD_off(string $titre, string $description, string $formation, string $softskills, string $competences, string $date_debut, string $duree, string $lieu, string $salaire, string $date_pub,string $id_entreprise){
        $user_actif = $_COOKIE['user_id'] ?? null;
        $section = $_GET['section'] ?? null;

        $sql = "INSERT INTO $section (titre, description, formation, softskills, competences, date_debut, duree, lieu, salaire, date_pub, id_createur, id_entreprise) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$titre, $description, $formation, $softskills, $competences, $date_debut, $duree, $lieu, $salaire, $date_pub, $user_actif, $id_entreprise]);
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
    
    public function getAllEntreprises()
    {
        $sql = "SELECT id_entreprise, nom FROM entreprises";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
 
    public function ajoutBDDWishlist(string $id_offre, string $titre)
    {
        $user_actif = $_COOKIE['user_id'] ?? null;
        $sql = "INSERT INTO wishlist (id_utilisateur, id_offre, titre)
                VALUES(?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_actif, $id_offre, $titre]);
    }
 
    public function getEntById(string $id_entreprise)
    {
        $sql = "SELECT * FROM entreprises WHERE id_entreprise = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_entreprise]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
    public function getOffreById(string $id_offre)
    {
        $sql = "SELECT * FROM offres WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_offre]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function ajoutBDDAgenda(string $id_offre, string $titre)
    {
        $user_actif = $_COOKIE['user_id'] ?? null;
        $sql = "INSERT INTO agenda (id_utilisateur, id_offre, titre)
                VALUES(?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_actif, $id_offre, $titre]);
    }
 
    
    
    public function searchGlobal($search, $type)
    {
        $search = "%$search%";
    
        if ($type === 'entreprise') {
            $sql = "SELECT e.nom, e.description, e.email_contact, e.telephone_contact,
                    COUNT(DISTINCT a.id_utilisateur) AS nb_stagiaires,
                    ROUND(AVG(ev.note), 1) AS moyenne_evaluation
                    FROM entreprises e
                    LEFT JOIN offres o ON o.id_entreprise = e.id_entreprise
                    LEFT JOIN agenda a ON a.id_offre = o.id
                    LEFT JOIN evaluation ev ON ev.id_entreprise = e.id_entreprise
                    WHERE e.nom LIKE :search 
                    OR e.description LIKE :search 
                    OR e.email_contact LIKE :search
                    OR e.telephone_contact LIKE :search
                    GROUP BY e.id_entreprise";
        }
    
        elseif ($type === 'offre') {
            $entreprise = $_GET['entreprise'] ?? '';
            $salaire_filtre = $_GET['salaire'] ?? '';
            $date_debut = $_GET['date_debut'] ?? '';
            $competences = $_GET['competences'] ?? '';
        
            $conditions = ["1=1"];
            $params = [];
        
            if ($search !== '%%') {
                $conditions[] = "(o.titre LIKE :search OR o.description LIKE :search)";
                $params['search'] = $search;
            }
        
            if ($competences) {
                $conditions[] = "o.competences LIKE :competences";
                $params['competences'] = "%$competences%";
            }
        
            if ($entreprise) {
                $conditions[] = "e.nom LIKE :entreprise";
                $params['entreprise'] = "%$entreprise%";
            }
        
            if ($salaire_filtre === 'smic_moins') {
                $conditions[] = "o.salaire < 1426";
            } elseif ($salaire_filtre === 'smic_plus') {
                $conditions[] = "o.salaire >= 1426";
            }
        
            if ($date_debut) {
                $conditions[] = "o.date_debut >= :date_debut";
                $params['date_debut'] = $date_debut;
            }
        
            $sql = "SELECT o.titre, o.description, o.competences, o.salaire, o.date_pub,
                    e.nom AS entreprise,
                    COUNT(DISTINCT a.id_utilisateur) AS nb_candidats
                    FROM offres o
                    LEFT JOIN entreprises e ON e.id_entreprise = o.id_entreprise
                    LEFT JOIN agenda a ON a.id_offre = o.id
                    WHERE " . implode(" AND ", $conditions) . "
                    GROUP BY o.id";
        
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                FROM entreprises 
                WHERE nom LIKE :search OR description LIKE :search
    
                UNION
    
                SELECT titre AS titre, description AS info, 'offre' AS type_result 
                FROM offres 
                WHERE titre LIKE :search OR description LIKE :search OR competences LIKE :search
    
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

    public function SupprimerEnt(string $id){
        $section = $_GET['section'];

        $sql = "DELETE FROM $section WHERE id_entreprise = ? ";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function SupprimerOff(string $id){
        $section = $_GET['section'];

        $sql = "DELETE FROM $section WHERE id = ? ";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function SupprimerWhishlist(string $id){
        $user_actif = $_COOKIE['user_id'] ?? null;

        $sql = "SELECT w.id_offre, o.titre
            FROM wishlist w
            JOIN offre o ON o.id_offre = w.id_offre
            WHERE w.id_utilisateur = ?";
    
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id, $user_actif]);
    }

    public function ModifierOff(string $titre, string $description, string $formation, string $softskills, string $competences,  string $date_debut, string $duree, string $lieu, string $salaire, string $date_pub, string $id_entreprise, string $id_offre){
    $user_actif = $_COOKIE['user_id'] ?? null;
   

    $sql = "UPDATE offres SET titre =?, description=?, formation=?, softskills=?, competences=?, date_debut=?, duree=?, lieu=?, salaire=?, date_pub=?, id_createur=?, id_entreprise=? 
            WHERE id =?";
    $stmt = $this->pdo->prepare($sql);
    
    return $stmt->execute([$titre, $description, $formation, $softskills, $competences, $date_debut, $duree, $lieu, $salaire, $date_pub, $user_actif, $id_entreprise, $id_offre]);
    }

};