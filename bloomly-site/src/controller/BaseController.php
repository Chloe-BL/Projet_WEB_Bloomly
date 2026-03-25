<?php

use Twig\Environment; //Charge l'environnement de Twig
use Twig\Loader\FilesystemLoader; //Charge le loader de Twig

abstract class BaseController
{
    protected Environment $twig; // Propriété pour stocker l'environnement Twig

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../templates'); // Indique à Twig où se trouvent les templates
        $this->twig = new Environment($loader); // Crée une instance de l'environnement Twig
    }

    protected function render(string $template, array $data = [])
    {
        if (!isset($data['connect'])) {
            $data['connect'] = $this->getConnect();
        }

        if (!isset($data['user'])) {
            $data['user'] = $_GET['user'] ?? '';
        }

        echo $this->twig->render($template, $data);
    }

    protected function getConnect()
    {
        return isset($_GET['connect']) && $_GET['connect'] === 'oui';
    }

    protected function getUser()
    {
        return $_GET['user'] ?? '';
    }

    protected function getSection()
    {
        return $_GET['section'] ?? '';
    }

}