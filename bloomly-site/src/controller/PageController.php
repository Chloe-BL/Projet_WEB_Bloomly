<?php
 
class PageController extends BaseController
{
    public function accueil()
    {
        $this->render('accueil.twig');
    }
 
    public function a_propos()
    {
        $this->render('a_propos.twig');
    }
 
    public function mentions_legales()
    {
        $this->render('mentions_legales.twig');
    }
 
    public function cookies()
    {
        $this->render('cookies.twig');
    }

    public function ajout()
    {
        $section = $_GET['section'] ?? null;
        $user = $_GET['user'] ?? null;
        $connect = $this->getConnect();

        if ($section && $user && $connect) {
            $this->render('ajout.twig', ['section' => $section, 'user' => $user, 'connect' => $connect]);
        } else {        
            echo "Paramètres manquants pour l'ajout.";
        }
    }
}