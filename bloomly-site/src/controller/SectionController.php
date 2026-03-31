<?php

use Twig\Environment; //Charge l'environnement de Twig
use Twig\Loader\FilesystemLoader; //Charge le loader de Twig

class SectionController extends BaseController
{
    private SectionModel $sectionModel;
    private FonctionnaliteModel $fonctionModel;

    public function __construct()
    {
        parent::__construct();
        $this->sectionModel = new SectionModel();
        $this->fonctionModel = new FonctionnaliteModel();
    }

    public function choix_section()
    {
        $section = $this -> getSection();
        $items = $this->sectionModel->getItemsBySection($section);

        if ($items === null) {
            echo "Erreur";
            return;
        }

        return $this -> liste($items, $section);

    }

    private function liste(array $items, string $section)
    {
        $parPage = 9;
        $page = isset($_GET['p']) ? (int) $_GET['p'] : 1;

        $id_etud = $_GET['id_etud'] ?? null;

        $pagination = new Pagination($items, $parPage, $page);

        if ($section == 'offres'){
            foreach ($items as &$item) {
                $item['favori'] = $this->fonctionModel->Favori($item['id']);
            }
        }

        $this->render('listes.twig', [
            'itemsPage' => $pagination->getItemsPage(),
            'page' => $pagination->getPage(),
            'totalPages' => $pagination->getTotalPages(),
            'section' => $section,
            'date' => date('d/m/Y'),
            'id_etud' => $id_etud
        ]);
    }
}