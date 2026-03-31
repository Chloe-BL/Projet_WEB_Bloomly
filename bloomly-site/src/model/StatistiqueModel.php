<?php

class StatistiqueModel extends BaseModel
{
    public function getRepartitionDureeStages()
    {
        $sql = "SELECT duree, COUNT(*) AS total
                FROM offres
                GROUP BY duree
                ORDER BY total DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTopWishlist()
    {
        $sql = "SELECT o.titre, COUNT(w.id_offre) AS total_wishlist
                FROM wishlist w
                JOIN offres o ON w.id_offre = o.id
                GROUP BY o.id, o.titre
                ORDER BY total_wishlist DESC
                LIMIT 5";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalOffres()
    {
        $sql = "SELECT COUNT(*) AS total FROM offres";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getMoyenneCandidatures()
    {
        $sql = "SELECT ROUND(COUNT(c.id_agenda) / COUNT(DISTINCT o.id), 2) AS moyenne
                FROM offres o
                LEFT JOIN agenda c ON c.id_offre = o.id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['moyenne'];
    }
}
