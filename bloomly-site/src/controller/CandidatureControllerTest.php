<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/CandidatureController.php';
require_once __DIR__ . '/..//outils/Upload.php';

class CandidatureControllerTest extends TestCase
{
    protected function setUp(): void
    {
        $_GET = [];
        $_POST = [];
        $_FILES = [];
        $_SERVER = [];
    }

    public function testAfficheLaVueEnGet()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['user'] = 'abdellah';

        $uploadMock = $this->createMock(Upload::class);

        $controller = $this->getMockBuilder(CandidatureController::class)
    ->disableOriginalConstructor()
    ->onlyMethods(['render', 'getConnect'])
    ->getMock();

        $controller->method('getConnect')->willReturn(true);

        $controller->expects($this->once())
            ->method('render')
            ->with(
                'candidature.twig',
                $this->callback(function ($data) {
                    return $data['message'] === ''
                        && $data['user'] === 'abdellah'
                        && $data['connect'] === true;
                })
            );

        $controller->setUpload($uploadMock);        
            $controller->candidature();
    }

    public function testPostEtudAvecFichierValideEtEnregistrementOk()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['action'] = 'etud';
        $_POST['Lettre'] = 'Ma lettre';
        $_FILES['cv'] = ['name' => 'cv.pdf'];

        $uploadMock = $this->createMock(Upload::class);
        $uploadMock->method('validerFichier')->willReturn(true);
        $uploadMock->method('enregistrerFichier')->willReturn('cv_final.pdf');

        $controller = $this->getMockBuilder(CandidatureController::class)
    ->disableOriginalConstructor()
    ->onlyMethods(['render', 'getConnect'])
    ->getMock();

        $controller->method('getConnect')->willReturn(false);

        $controller->expects($this->once())
            ->method('render')
            ->with(
                'candidature.twig',
                $this->callback(function ($data) {
                    return str_contains($data['message'], 'Candidature envoyée avec succès.')
                        && str_contains($data['message'], 'cv_final.pdf')
                        && str_contains($data['message'], 'Ma lettre');
                })
            );

        $controller->setUpload($uploadMock);        
            $controller->candidature();
    }

    public function testPostEtudAvecFichierValideMaisEnregistrementKo()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['action'] = 'etud';
        $_POST['Lettre'] = 'Test';
        $_FILES['cv'] = ['name' => 'cv.pdf'];

        $uploadMock = $this->createMock(Upload::class);
        $uploadMock->method('validerFichier')->willReturn(true);
        $uploadMock->method('enregistrerFichier')->willReturn(false);

        $controller = $this->getMockBuilder(CandidatureController::class)
    ->disableOriginalConstructor()
    ->onlyMethods(['render', 'getConnect'])
    ->getMock();

        $controller->method('getConnect')->willReturn(false);

        $controller->expects($this->once())
            ->method('render')
            ->with(
                'candidature.twig',
                $this->callback(function ($data) {
                    return $data['message'] === "Erreur lors de l'enregistrement du fichier.";
                })
            );

        $controller->setUpload($uploadMock);        
            $controller->candidature();
    }

    public function testPostEtudAvecFichierInvalide()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['action'] = 'etud';
        $_POST['Lettre'] = 'Test';
        $_FILES['cv'] = ['name' => 'cv.exe'];

        $uploadMock = $this->createMock(Upload::class);
        $uploadMock->method('validerFichier')->willReturn('Fichier invalide');

        $controller = $this->getMockBuilder(CandidatureController::class)
    ->disableOriginalConstructor()
    ->onlyMethods(['render', 'getConnect'])
    ->getMock();

        $controller->method('getConnect')->willReturn(false);

        $controller->expects($this->once())
            ->method('render')
            ->with(
                'candidature.twig',
                $this->callback(function ($data) {
                    return $data['message'] === 'Fichier invalide';
                })
            );

        $controller->setUpload($uploadMock);        
            $controller->candidature();
    }

    public function testPostAdminPil()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['action'] = 'admin_pil';
        $_POST['Lettre'] = 'Très bon candidat';
        $_GET['user'] = 'admin';

        $uploadMock = $this->createMock(Upload::class);

        $controller = $this->getMockBuilder(CandidatureController::class)
    ->disableOriginalConstructor()
    ->onlyMethods(['render', 'getConnect'])
    ->getMock();

        $controller->method('getConnect')->willReturn(true);

        $controller->expects($this->once())
            ->method('render')
            ->with(
                'candidature.twig',
                $this->callback(function ($data) {
                    return $data['user'] === 'admin'
                        && str_contains($data['message'], 'Appréciation : Très bon candidat');
                })
            );

            $controller->setUpload($uploadMock);        
            $controller->candidature();
    }
}