<?php

// Ces lignes permettent de détecter d'afficher les possibles erreurs lors du développement
error_reporting(E_ALL); 
ini_set('display_errors', 1);


require_once __DIR__ . '/vendor/autoload.php'; // Chargement de l'autoload de Composer pour Twig et autres dépendances
require_once __DIR__ . '/src/controller/BaseController.php';
require_once __DIR__ . '/src/controller/PageController.php';
require_once __DIR__ . '/src/controller/AuthController.php';
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
    (new AuthController()) -> inscription();
}

elseif ($page === 'connexion') {
    (new AuthController()) -> connexion();
}

elseif ($page === 'validationConnexion'){
    (new AuthController()) -> validationConnexion();
}

elseif ($page === 'choix_section') {
    (new SectionController())  -> choix_section();
}

elseif ($page === 'mon_espace') {
    (new AuthController()) -> mon_espace();
}

elseif ($page === 'candidature') {
    (new CandidatureController())  -> candidature();
}

elseif ($page === 'ajout') {
    (new FonctionnaliteController()) -> ajout();
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