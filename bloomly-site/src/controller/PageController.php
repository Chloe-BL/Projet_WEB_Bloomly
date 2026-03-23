<?php
 
class PageController extends BaseController
{
    public function accueil(): void
    {
        $this->render('accueil.twig');
    }
 
    public function aPropos(): void
    {
        $this->render('a_propos.twig');
    }
 
    public function mentionsLegales(): void
    {
        $this->render('mentions_legales.twig');
    }
 
    public function cookies(): void
    {
        $this->render('cookies.twig');
    }
}