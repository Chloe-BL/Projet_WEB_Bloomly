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

elseif ($page === 'a_propos') {
    (new PageController()) -> a_propos();
}

elseif ($page === 'mentions_legales') {
    (new PageController()) -> mentions_legales();
}

elseif ($page === 'cookies') {
    (new PageController()) -> cookies();
}

else {
    echo "Page non trouvée";
}