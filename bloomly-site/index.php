<?php

// Ces lignes permettent de détecter d'afficher les possibles erreurs lors du développement
error_reporting(E_ALL); 
ini_set('display_errors', 1);


require_once __DIR__ . '/vendor/autoload.php'; // Chargement de l'autoload de Composer pour Twig et autres dépendances

require_once __DIR__ . '/src/controller/BaseController.php';
require_once __DIR__ . '/src/controller/PageController.php';
require_once __DIR__ . '/src/controller/UserController.php';
require_once __DIR__ . '/src/controller/SectionController.php';
require_once __DIR__ . '/src/controller/CandidatureController.php';
require_once __DIR__ . '/src/controller/FonctionnaliteController.php';
require_once __DIR__ . '/src/model/UserModel.php';
require_once __DIR__ . '/src/model/SectionModel.php';
require_once __DIR__ . '/src/model/ProfilModel.php';
require_once __DIR__ . '/src/model/FonctionnaliteModel.php';
require_once __DIR__ . '/src/model/StatistiqueModel.php';
require_once __DIR__ . '/src/outils/Pagination.php';
require_once __DIR__ . '/src/outils/Upload.php';
 

$page = $_GET['page'] ?? '/bloomly-site.local/index';                                                                                                   

if ($page === 'accueil') {
    (new PageController()) -> accueil();
}

elseif ($page === 'inscription') {
    (new UserController()) -> inscription();
}

elseif ($page === 'connexion') {
    (new UserController()) -> connexion();
}

elseif ($page === 'validationConnexion'){
    (new UserController()) -> validationConnexion();
}

elseif ($page === 'choix_section') {
    (new SectionController())  -> choix_section();
}

elseif ($page === 'mon_espace') {
    (new UserController()) -> mon_espace();
}

elseif ($page === 'candidature') {
    (new CandidatureController())  -> candidature();
}

elseif ($page === 'ajout_ent') {
    (new FonctionnaliteController()) -> ajout_ent();
}

elseif ($page === 'ajout_off') {
    (new FonctionnaliteController()) -> ajout_off();
}

elseif ($page === 'ajout_etudiant') {
    (new UserController()) -> inscription();
}

elseif ($page === 'ajout_pilote') {
    (new UserController()) -> inscription();
}

elseif ($page === 'DescriptionOff'){
    (new FonctionnaliteController()) -> description_off();
}

elseif ($page === 'DescriptionEnt'){
    (new FonctionnaliteController()) -> description_ent();
}

elseif ($page === 'description_etu'){
    (new FonctionnaliteController()) -> description_etu();
}

elseif ($page === 'description_pil'){
    (new FonctionnaliteController()) -> description_pil();
}

elseif ($page === 'ValidationAjout_ent'){
    (new FonctionnaliteController()) -> ValidationAjout_ent();
}

elseif ($page === 'ValidationAjout_off'){
    (new FonctionnaliteController()) -> ValidationAjout_off();
}

elseif ($page === 'ValidationAjout_etudiant'){
    (new FonctionnaliteController()) -> ValidationAjout_etudiant();
}

elseif ($page === 'ValidationAjout_pilote'){
    (new FonctionnaliteController()) -> ValidationAjout_pilote();
}

elseif ($page === 'SupprimerOff'){
    (new FonctionnaliteController()) -> supprimer_off();
}

elseif ($page === 'SupprimerEnt'){
    (new FonctionnaliteController()) -> supprimer_ent();
}

elseif ($page === 'SupprimerEtudiant'){
    (new FonctionnaliteController()) -> supprimer_etudiant();
}

elseif ($page === 'SupprimerPilot'){
    (new FonctionnaliteController()) -> supprimer_pilot();
}

elseif ($page === 'modifier_offre'){
    (new FonctionnaliteController()) -> modif_off();
}

elseif ($page === 'ValidationModif_off'){
    (new FonctionnaliteController()) -> ValidationModif_off();
}

elseif ($page === 'modifier_entreprise'){
    (new FonctionnaliteController()) -> modif_ent();
}

elseif ($page === 'ValidationModif_ent'){
    (new FonctionnaliteController()) -> ValidationModif_ent();
}

elseif ($page === 'AddFavoris'){
    (new FonctionnaliteController()) -> AddFavoris();
}

elseif ($page === 'AddAgenda'){
    (new FonctionnaliteController()) -> AddAgenda();
}

elseif ($page === 'a_propos') {
    (new PageController()) -> a_propos();
}

elseif ($page === 'mentions_legales') {
    (new PageController()) -> mentions_legales();
}

elseif ($page === 'cookies') {
    (new PageController()) -> cookies();
}

elseif ($page === 'search') {
    (new PageController())->search();
}

else {
    echo "Page non trouvée";
}