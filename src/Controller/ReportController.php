<?php

namespace App\Controller;

use App\Service\NewsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ReportController extends AbstractController
{
    #[Route('/report', name: 'app_report')]
    public function index(NewsService $newsService): Response
    {
        return $this->render('report/index.html.twig', [
            'categories' => $newsService->getCategoryList(),
            'controller_name' => 'ReportController',
        ]);
    }
}
