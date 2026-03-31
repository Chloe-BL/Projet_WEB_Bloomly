<?php
 
class PageController extends BaseController
{
    public function accueil()
    {
        $this->render('accueil.twig');
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
    $entreprise = $_GET['entreprise'] ?? '';
    $competences = $_GET['competences'] ?? '';
    $salaire = $_GET['salaire'] ?? '';
    $date_debut = $_GET['date_debut'] ?? '';
    $description = $_GET['description'] ?? '';
    $email = $_GET['email'] ?? '';
    $telephone = $_GET['telephone'] ?? '';
 
    $model = new FonctionnaliteModel();
 
    // Si type offre ou entreprise ET aucun filtre avancé rempli
    // → on affiche juste le formulaire sans résultats
    $filtres_remplis = $entreprise || $competences || $salaire || $date_debut || $description || $email || $telephone || $search;
 
    if (($type === 'offre' || $type === 'entreprise') && !$filtres_remplis) {
        $resultats = []; // pas de résultats, juste le formulaire
    } else {
        $resultats = $model->searchGlobal($search, $type);
    }
 
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
        'telephone' => $telephone
    ]);
}
};