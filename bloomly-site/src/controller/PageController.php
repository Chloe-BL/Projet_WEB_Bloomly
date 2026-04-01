<?php
 
class PageController extends BaseController
{
    public function accueil()
    {
        $statistiqueModel = new StatistiqueModel();

        $repartition = $statistiqueModel->getRepartitionDureeStages();
        $topWishlist = $statistiqueModel->getTopWishlist();
        $totalOffres = $statistiqueModel->getTotalOffres();
       // $moyenneCandidatures = $statistiqueModel->getMoyenneCandidatures();

        echo $this->twig->render('accueil.twig', [
            'repartition' => $repartition,
            'topWishlist' => $topWishlist,
            'totalOffres' => $totalOffres,
            //'moyenneCandidatures' => $moyenneCandidatures
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
    $connect = $_GET['connect'] ?? null;
    $search = $_GET['search'] ?? '';
    $type = $_GET['type'] ?? 'all';
    $entreprise = $_GET['entreprise'] ?? '';
    $competences = $_GET['competences'] ?? '';
    $salaire = $_GET['salaire'] ?? '';
    $date_debut = $_GET['date_debut'] ?? '';
    $description = $_GET['description'] ?? '';
    $email = $_GET['email'] ?? '';
    $telephone = $_GET['telephone'] ?? '';
    $nb_candidats = $_GET['nb_candidats'] ?? '';
    $nb_stagiaires = $_GET['nb_stagiaires'] ?? '';
 
    $model = new FonctionnaliteModel();
 
    $filtres_remplis = $entreprise || $competences || $salaire || $date_debut 
                    || $description || $email || $telephone || $search
                    || $nb_candidats || $nb_stagiaires;
 
    if (($type === 'offre' || $type === 'entreprise') && !$filtres_remplis) {
        $resultats = [];
    } else {
        $resultats = $model->searchGlobal($search, $type, $connect);
    }
 
    $liste_competences = $model->getCompetences();
 
    $this->render('resultats.twig', [
        'resultats' => $resultats,
        'search' => $search,
        'type' => $type,
        'entreprise' => $entreprise,
        'competences' => $competences,
        'salaire' => $salaire,
        'date_debut' => $date_debut,
        'description' => $description,
        'email' => $email,
        'telephone' => $telephone,
        'nb_candidats' => $nb_candidats,
        'nb_stagiaires' => $nb_stagiaires,
        'liste_competences' => $liste_competences,
        'resultats' => $resultats,
        'connect' => $_GET['connect'] ?? null,
        'user' => $_GET['user'] ?? null,
        ]);
}

};