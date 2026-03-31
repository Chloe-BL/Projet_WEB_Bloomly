<?php

class AccueilController extends BaseController
{
    public function index()
    {
        $StatistiqueModel = new StatistiqueModel();

        $repartition = $statistiqueModel->getRepartitionDureeStages();
        $topWishlist = $statistiqueModel->getTopWishlist();
        $totalOffres = $statistiqueModel->getTotalOffres();
        $moyenneCandidatures = $statistiqueModel->getMoyenneCandidatures();

        var_dump($repartition, $topWishlist, $totalOffres, $moyenneCandidatures);
    die();

        echo $this->twig->render('accueil.twig', [
            'repartition' => $repartition,
            'topWishlist' => $topWishlist,
            'totalOffres' => $totalOffres,
            'moyenneCandidatures' => $moyenneCandidatures
        ]);
    }
}