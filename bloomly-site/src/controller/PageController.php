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
        $section = $this -> getSection();

        $this->render('ajout.twig',[
        'section' => $section
        ]);
    }
}