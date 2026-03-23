<?php

class SectionController extends BaseController
{
    private SectionModel $sectionModel;

    public function __construct()
    {
        parent::__construct();
        $this->sectionModel = new SectionModel();
    }

    public function choix_section(): void
    {
        $section = $_GET['section'] ?? '';
        $items = $this->sectionModel->getItemsBySection($section);

        if ($items === null) {
            echo "Erreur";
            return;
        }

        $this->liste($items, $section);
    }

    private function liste(array $items, string $section): void
    {
        $parPage = 9;
        $page = isset($_GET['p']) ? (int) $_GET['p'] : 1;

        $pagination = new Pagination($items, $parPage, $page);

        $this->render('listes.twig', [
            'itemsPage' => $pagination->getItemsPage(),
            'page' => $pagination->getPage(),
            'totalPages' => $pagination->getTotalPages(),
            'section' => $section,
            'user' => $_GET['user'] ?? '',
            'connect' => $this->getConnect(),
            'date' => date('d/m/Y')
        ]);
    }
}