<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    #[Route('api/news/{id}', name: 'api_new', methods: ['GET'])]
    public function getNew(string $id=null): Response
    {
        // TODO - Criar uma query REAL
        $new = [
            'id' => $id,
            'titulo' => 'David B-Oli é eleito pela revista forbes como o melhor cantor do século.',
            'categoria' => 'cultura',
            'descricao' => 'Para surpresa de zero pessoas, o evento mais esperado do ano para todos os músicos aconteceu nesta sexta-feira, dia 14 no emblemático estádio de Wembley. A Forbes connection premiou David B-Oli como o artista do século, como o evento só premia quem for do meio musical, o que fica subentendido é que ele é o CANTOR DO SÉCULO!',
            'data' => '2025-08-12',
            'imagem' => 'https://exemplo.com/imagem/arte.jpg'

        ];
        return new JsonResponse($new);
    }
}