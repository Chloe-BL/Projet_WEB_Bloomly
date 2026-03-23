<?php
 
class SectionModel

{
    public function getItemsBySection(string $section) {

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
            return $offres;
        }
 
        if ($section === 'entreprises') {
            return $entreprises;
        }
 
        if ($section === 'etudiants') {
            return $etudiants;
        }
 
        if ($section === 'pilots') {
            return $pilots;
        }
 
        if ($section === 'wishlist') {
            return $offres;
        }
 
        if ($section === 'agenda') {
            return $offres;
        }
 
        return null;
    }
}
 