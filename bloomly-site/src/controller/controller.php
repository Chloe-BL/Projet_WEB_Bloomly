<?php

use Twig\Loader\FilesystemLoader; //Charge le loader de Twig
use Twig\Environment; //Charge l'environnement de Twig

class Controller
{
    private Environment $twig; // Propriété pour stocker l'environnement Twig

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../templates'); // Indique à Twig où se trouvent les templates
        $this -> twig = new Environment($loader); // Crée une instance de l'environnement Twig
    }     
}
