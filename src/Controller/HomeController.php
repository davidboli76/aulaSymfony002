<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {

        $categories = [
            ['title' => 'Mundo',            'text' => 'Notícias sobre o Mundo'],
            ['title' => 'Brasil',           'text' => 'Notícias sobre o Brasil'],
            ['title' => 'Tecnologia',       'text' => 'Notícias sobre Tecnologia'],
            ['title' => 'Design',           'text' => 'Notícias sobre Design'],
            ['title' => 'Cultura',          'text' => 'Notícias sobre Cultura'],
            ['title' => 'Negócios',         'text' => 'Notícias sobre Negócios'],
            ['title' => 'Política',         'text' => 'Notícias sobre Política'],
            ['title' => 'Opinião',          'text' => 'Notícias sobre Opinião'],
            ['title' => 'Ciência',          'text' => 'Notícias sobre Ciência'],
            ['title' => 'Saúde',            'text' => 'Notícias sobre Saúde'],
            ['title' => 'Estilo',           'text' => 'Notícias sobre Estilo'],
            ['title' => 'Viagens',          'text' => 'Notícias sobre Viagens']
        ];
        
        $pageTitle = "Sistema de notícias";
        return $this->render('home/home.html.twig', [
            'categories' => $categories,
            'pageTitle' => $pageTitle,
        ]);
    }

    #[Route('/categoria/{slug}', name: 'app_category')]
    public function category(string $slug=null): Response
    {
        $categories = [
            ['title' => 'Mundo',            'text' => 'Notícias sobre o Mundo'],
            ['title' => 'Brasil',           'text' => 'Notícias sobre o Brasil'],
            ['title' => 'Tecnologia',       'text' => 'Notícias sobre Tecnologia'],
            ['title' => 'Design',           'text' => 'Notícias sobre Design'],
            ['title' => 'Cultura',          'text' => 'Notícias sobre Cultura'],
            ['title' => 'Negócios',         'text' => 'Notícias sobre Negócios'],
            ['title' => 'Política',         'text' => 'Notícias sobre Política'],
            ['title' => 'Opinião',          'text' => 'Notícias sobre Opinião'],
            ['title' => 'Ciência',          'text' => 'Notícias sobre Ciência'],
            ['title' => 'Saúde',            'text' => 'Notícias sobre Saúde'],
            ['title' => 'Estilo',           'text' => 'Notícias sobre Estilo'],
            ['title' => 'Viagens',          'text' => 'Notícias sobre Viagens']
        ];

        $pageTitle = "Notícias sobre" . $slug;
        return $this->render('home/category.html.twig', [
            'categories' => $categories,
            'pageTitle' => $pageTitle,
        ]);
    }
}