<? php

class SectionModel
{
    private $entreprises = [
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

     private $offres = [
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

    private $etudiants = [
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

    private $pilots = [
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

    private $section;

    public function __construct($section){
        $this -> section = $section;
        return $section;

    }

    public function getEntreprise($section){
        if ($section === 'entreprises')
            $this -> liste($offres, $section);
            return;
    }

    public function getOffres(){
        if ($section === 'offres')
            return $section;
    }

    public function getEtudiants(){
        if ($section === 'etudiants')
            return $section;
    }

    public function getPilots(){
        if ($section === 'pilots')
            return $section;
    }
}