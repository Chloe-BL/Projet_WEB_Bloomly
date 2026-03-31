<?php

require_once __DIR__ . '/BaseModel.php';

class StatistiqueModel extends BaseModel
{
    public function getNombreTotalOffres(): int
    {
        $sql = "SELECT COUNT(*) as total FROM offres";
        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetch();

        return (int) ($result['total'] ?? 0);
    }

    public function getMoyenneCandidaturesParOffre(): float
    {
        $sql = "
            SELECT AVG(nb_candidatures) as moyenne
            FROM (
                SELECT o.id_offre, COUNT(c.id_candidature) as nb_candidatures
                FROM offres o
                LEFT JOIN candidature c ON c.id_offre = o.id_offre
                GROUP BY o.id_offre
            ) stats
        ";
        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetch();

        return round((float) ($result['moyenne'] ?? 0), 1);
    }

    public function getRepartitionDureeStages(): array
    {
        $sql = "
            SELECT duree_stage, COUNT(*) as total
            FROM offres
            GROUP BY duree_stage
            ORDER BY total DESC
            LIMIT 3
        ";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }

    public function getTopWishlist(): array
    {
        // à adapter plus tard si vous avez une vraie table wishlist
        // pour l’instant on simule à partir des offres existantes
        $sql = "
            SELECT titre
            FROM offres
            ORDER BY id_offre ASC
            LIMIT 3
        ";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }
}