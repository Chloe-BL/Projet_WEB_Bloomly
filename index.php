<?php

require "vendor/autoload.php";

use App\Controllers\TaskController;

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'debug' => true
]);

$page = $_GET['page'] ?? 'index.html';

$controller = new TaskController($twig);

if ($page === 'index.html') {
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