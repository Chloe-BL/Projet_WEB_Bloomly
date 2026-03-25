<?php

class FonctionnaliteController extends BaseController
{
    public function ajout()
    {
        $section = $this -> getSection();

        $this->render('ajout.twig',[
        'section' => $section
        ]);
    }

}