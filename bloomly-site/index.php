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
require_once __DIR__ . '/src/model/UserModel.php';
require_once __DIR__ . '/src/model/SectionModel.php';
require_once __DIR__ . '/src/model/ProfileModel.php';
require_once __DIR__ . '/src/outils/Pagination.php';
require_once __DIR__ . '/src/outils/Upload.php';
 

$page = $_GET['page'] ?? '/bloomly-site.local/index';

$controller = new TestController();

if ($page === 'accueil') {
    $controller -> accueil();
}

elseif ($page === 'inscription') {
    $controller -> inscription();
}

elseif ($page === 'connexion') {
    $controller -> connexion();
}

elseif ($page === 'validationConnexion'){
    $controller -> validationConnexion();
}

elseif ($page === 'choix_section') {
    $controller -> choix_section();
}

elseif ($page === 'mon_espace') {
    $controller -> mon_espace();
}

elseif ($page === 'candidature') {
    $controller -> candidature();
}

elseif ($page === 'a_propos') {
    $controller -> a_propos();
}

elseif ($page === 'mentions_legales') {
    $controller -> mentions_legales();
}

elseif ($page === 'cookies') {
    $controller -> cookies();
}



else {
    echo "Page non trouvée";
}