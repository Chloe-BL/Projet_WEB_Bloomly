<?php

// Ces lignes permettent de détecter d'afficher les possibles erreurs lors du développement
error_reporting(E_ALL); 
ini_set('display_errors', 1);

require_once __DIR__ . '/vendor/autoload.php'; // Chargement de l'autoload de Composer pour Twig et autres dépendances
require_once __DIR__ . '/src/controller/controller.php'; // Chargement du contrôleur

$page = $_GET['page'] ?? '/bloomly-site.local/index';

$controller = new TestController();

if ($page === 'choix_section') {
    $controller -> choix_section();
}

elseif ($page === 'candidature') {
    $controller -> candidature();
}

elseif ($page === 'connexion') {
    $controller -> connexion();
}

elseif ($page === 'validationConnexion'){
    $controller -> validationConnexion();
}

elseif ($page === 'mon_espace') {
    $controller -> mon_espace();
}

else {
    echo "Page non trouvée";
}