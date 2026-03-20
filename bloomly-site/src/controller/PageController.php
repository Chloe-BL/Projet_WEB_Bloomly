<?php

class PageController
{
    public function __construct(){

    }

    public function liste( array $items, $section){

        $parPage = 9;
        $page = isset($_GET['p']) ? (int) $_GET['p'] : 1;

        $connect = $this -> getConnect();

        $pagination = new Pagination($items, $parPage, $page);

        echo $this -> twig -> render('listes.twig', [
            'itemsPage' => $pagination -> getItemsPage(),
            'page' => $pagination -> getPage(),
            'totalPages' => $pagination -> getTotalPages(),
            'section' => $section,
            'user' => $_GET['user'] ?? '',
            'connect' => $connect
        ]);
    }
    
    public function accueil(){
        echo $this -> twig -> render('accueil.twig');
    }

    public function a_propos(){
        echo $this -> twig -> render('a_propos.twig');
    }

    public function mentions_legales(){
        echo $this -> twig -> render('mentions_legales.twig');
    }

    public function cookies(){
        echo $this -> twig -> render('cookies.twig');
    }

    public function choix_section(){
        $section = $_GET['section'] ?? '';

        $entreprises = [
        "NexoraTech",
        "SynaptIQ Solutions",
        "TechVortex",
        "SecureFlow Systems",
        "DataNova",
        "CloudBridge",
        "InnovaDev",
        "OmniTech",
        "Prime Solutions",
        "LogicBloom",
        "CyberNest",
        "CloudHive",
        "HyperNova",
        "IntelliSoft",
        "NextGen Digital",
        "Orbit Systems",
        "SecureMind",
        "TechRoots",
        "VisionCode",
        "WaveLogic",
        "ZenIT",
        "MetaSoft",
        "Digital Horizon"
    ];

    $offres = [
        "Stage Développeur Web - NexoraTech",
        "Stage Data Analyst - SynaptIQ Solutions",
        "Stage Développeur Backend - TechVortex",
        "Stage Cybersécurité - SecureFlow Systems",
        "Stage Data Science - DataNova",
        "Stage Cloud Computing - CloudBridge",
        "Stage Développeur Full Stack - InnovaDev",
        "Stage DevOps - OmniTech",
        "Stage Développeur Java - Prime Solutions",
        "Stage Développeur Frontend - LogicBloom",
        "Stage Sécurité Informatique - CyberNest",
        "Stage Architecte Cloud - CloudHive",
        "Stage Intelligence Artificielle - HyperNova",
        "Stage Développeur Python - IntelliSoft",
        "Stage Développeur Mobile - NextGen Digital",
        "Stage Infrastructure IT - Orbit Systems",
        "Stage Analyste Sécurité - SecureMind",
        "Stage Développeur PHP - TechRoots",
        "Stage Développeur Logiciel - VisionCode",
        "Stage Data Engineer - WaveLogic",
        "Stage Support IT - ZenIT",
        "Stage Développeur Node.js - MetaSoft",
        "Stage Développeur React - Digital Horizon"
    ];

    $etudiants = [
        ["nom" => "Martin", "prenom" => "Lucas"],
        ["nom" => "Nguyen", "prenom" => "Linh"],
        ["nom" => "Diallo", "prenom" => "Aminata"],
        ["nom" => "Garcia", "prenom" => "Carlos"],
        ["nom" => "Kowalski", "prenom" => "Anna"],
        ["nom" => "Benali", "prenom" => "Yassine"],
        ["nom" => "Dubois", "prenom" => "Emma"],
        ["nom" => "Santos", "prenom" => "Mateus"],
        ["nom" => "Kim", "prenom" => "Jisoo"],
        ["nom" => "Rossi", "prenom" => "Giulia"],
        ["nom" => "Haddad", "prenom" => "Nour"],
        ["nom" => "Moreau", "prenom" => "Gabriel"],
        ["nom" => "Singh", "prenom" => "Arjun"],
        ["nom" => "Ivanov", "prenom" => "Dmitri"],
        ["nom" => "Fernandez", "prenom" => "Sofia"],
        ["nom" => "Traoré", "prenom" => "Moussa"],
        ["nom" => "Schmidt", "prenom" => "Lena"],
        ["nom" => "Alvarez", "prenom" => "Diego"],
        ["nom" => "Okafor", "prenom" => "Chinedu"],
        ["nom" => "Tanaka", "prenom" => "Yuki"]
    ];

    $pilots = [
        ["nom" => "Martin", "prenom" => "Lucas"],
        ["nom" => "Nguyen", "prenom" => "Linh"],
        ["nom" => "Diallo", "prenom" => "Aminata"],
        ["nom" => "Garcia", "prenom" => "Carlos"],
        ["nom" => "Kowalski", "prenom" => "Anna"],
        ["nom" => "Benali", "prenom" => "Yassine"],
        ["nom" => "Dubois", "prenom" => "Emma"],
        ["nom" => "Santos", "prenom" => "Mateus"],
        ["nom" => "Kim", "prenom" => "Jisoo"],
        ["nom" => "Rossi", "prenom" => "Giulia"],
        ["nom" => "Haddad", "prenom" => "Nour"],
        ["nom" => "Moreau", "prenom" => "Gabriel"],
        ["nom" => "Singh", "prenom" => "Arjun"],
        ["nom" => "Ivanov", "prenom" => "Dmitri"],
        ["nom" => "Fernandez", "prenom" => "Sofia"],
        ["nom" => "Traoré", "prenom" => "Moussa"],
        ["nom" => "Schmidt", "prenom" => "Lena"],
        ["nom" => "Alvarez", "prenom" => "Diego"],
        ["nom" => "Okafor", "prenom" => "Chinedu"],
        ["nom" => "Tanaka", "prenom" => "Yuki"]
    ];

        if ($section === 'offres') {
            $this -> liste($offres, $section);
            return;
        }
        elseif ($section === 'entreprises') {
            $this -> liste($entreprises, $section);
            return;
        }
        elseif ($section === 'etudiants') {
            $this -> liste($etudiants, $section);
            return;
        }
        elseif ($section === 'pilots') {
            $this -> liste($pilots, $section);
            return;
        }
        elseif ($section === 'wishlist') {
            $this -> liste($offres, $section);
            return;
        }
        elseif ($section === 'agenda') {
            $this -> liste($offres, $section);
            return;
        }
        else {
            echo "Erreur";
        }
    }
}