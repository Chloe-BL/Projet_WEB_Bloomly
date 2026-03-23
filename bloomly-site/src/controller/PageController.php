<?php
 
class PageController extends BaseController
{
    public function accueil(): void
    {
        $this->render('accueil.twig');
    }
 
    public function a_propos(): void
    {
        $this->render('a_propos.twig');
    }
 
    public function mentions_legales(): void
    {
        $this->render('mentions_legales.twig');
    }
 
    public function cookies(): void
    {
        $this->render('cookies.twig');
    }
}