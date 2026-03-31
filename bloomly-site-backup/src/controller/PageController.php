<?php
 
 require_once __DIR__ . '/../model/StatistiqueModel.php';

class PageController extends BaseController
{
    public function accueil()
{
    $statModel = new StatistiqueModel();

    $repartition = $statModel->getRepartitionDureeStages();
    $topWishlist = $statModel->getTopWishlist();
    $totalOffres = $statModel->getNombreTotalOffres();
    $moyenneCandidatures = $statModel->getMoyenneCandidaturesParOffre();

    $this->render('accueil.twig', [
        'repartition' => $repartition,
        'topWishlist' => $topWishlist,
        'totalOffres' => $totalOffres,
        'moyenneCandidatures' => $moyenneCandidatures
    ]);
}
 
    public function a_propos()
    {
        $this->render('a_propos.twig');
    }
 
    public function mentions_legales()
    {
        $this->render('mentions_legales.twig');
    }
 
    public function cookies()
    {
        $this->render('cookies.twig');
    }
    
    public function search()
    {
        $search = $_GET['search'] ?? '';
        $type = $_GET['type'] ?? 'all';

        $model = new FonctionnaliteModel();
        $resultats = $model->searchGlobal($search, $type);

        $this->render('resultats.twig', [
            'resultats' => $resultats,
            'search' => $search,
            'type' => $type
        ]);
    }

    public function candidature() {
        $this->render('candidature.twig', [
            'message' => $message,
            'user' => $user,
            'connect' => $this->getConnect(),
            'section' => $this -> getSection(),
            'id_offre' => $_GET['id_offre'],
            'titre' => $_GET['titre']
        ]);
    }

    public function evaluation(){
        $this->render('candidature.twig', [
            'message' => $message,
            'user' => $user,
            'connect' => $this->getConnect(),
            'section' => $this -> getSection(),
            'nom' => $_GET['nom'],
            'id_nom' => $_GET['id_nom']
        ]);
    }
};