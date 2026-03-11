<?php

// Ces lignes permettent de détecter d'afficher les possibles erreurs lors du développement
error_reporting(E_ALL); 
ini_set('display_errors', 1);

require_once __DIR__ . '/vendor/autoload.php'; // Chargement de l'autoload de Composer pour Twig et autres dépendances
require_once __DIR__ . '/src/controller/TestController.php'; // Chargement du contrôleur

$page = $_GET['page'] ?? 'index';

$controller = new TaskController($twig);

if ($page === 'index') {
    $controller->index();
} 

elseif ($page === 'candidature') {
    $controller -> candidature();
}

elseif ($page === 'edut_ent') {
    $controller -> edut_ent();
}

else {
    echo "Page non trouvée"
}