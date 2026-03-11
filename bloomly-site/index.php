<?php

// Ces lignes permettent de détecter d'afficher les possibles erreurs lors du développement
error_reporting(E_ALL); 
ini_set('display_errors', 1);

require_once __DIR__ . '/vendor/autoload.php'; // Chargement de l'autoload de Composer pour Twig et autres dépendances
require_once __DIR__ . '/src/controller/controller.php'; // Chargement du contrôleur

$page = $_GET['page'] ?? '/bloomly-site.local/index';

$controller = new TestController();

if ($page === '/bloomly-site.local/index') {
    $controller->index();
} 

elseif ($page === 'candidature') {
    $controller -> candidature();
}

elseif ($page === 'pilot_offres') {
    $controller -> liste();
}

else {
    echo "Page non trouvée";
}