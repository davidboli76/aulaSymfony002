<?php

namespace App\Controller;

use App\Entity\News;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    // #[Route('api/news/{id}', name: 'api_news', methods: ['GET'])]
    #[Route('api/news/{id}', name: 'api_news')]
    public function getNew(int $id=null): Response
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

    #[route('news/new')]
    public function new(EntityManagerInterface $entityManager): Response
    {
        $rand = rand(18, 30);
        $news = new News();
        $news->setTitle('Jovem de ' .  $rand . ' anos é agredido por uma mariposa apaixonada de guadalupe');
        $news->setDescription('Um jovem ardanueiro de ' .  $rand . ' anos que passava na rua Guadalupe se deparou com uma situação minimamente inusitada: Foi atacado por um grupo de mariposas vermelhas no momento em que a caixa onde elas estavam caiu do trem em movimento.');

        $entityManager->persist($news);
        $entityManager->flush();
        
        return new Response(
            '<h2>Última Notícia:</h2>' . $news->getTitle() .
            '<h3>Descrição:</h3>'. $news->getDescription() .
            '<h3>Atualizada em:</h3>' . $news->getCreateAt()->format('d/m/Y - h:i:s')
        );
    }
}