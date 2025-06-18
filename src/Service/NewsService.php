<?php

namespace App\Service;

use Psr\Cache\CacheItemInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class NewsService
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private CacheInterface $cache
    ) {}

    public function getCategoryList()
    {
        $categories = $this->cache->get('news_category', function(CacheItemInterface $cacheItem) {
            $cacheItem->expiresAfter(60);
            $url = "https://raw.githubusercontent.com/davidboli76/EstudosStmfony/refs/heads/main/arrayCategoryNews.json";
            $html = $this->httpClient->request('GET', $url);
            $news = $html->toArray();

            return $news;
        });

        return $categories;
    }

    public function getNewsList()
    {
        $newsList = $this->cache->get('news_list', function(CacheItemInterface $cacheItem) {
            $cacheItem->expiresAfter(60);
            $url = "https://raw.githubusercontent.com/davidboli76/EstudosStmfony/refs/heads/main/arrayNews.json";
            $html = $this->httpClient->request('GET', $url);
            $news = $html->toArray();

        // $news = [
        //     [
        //         "title" => "Governo anuncia investimento em tecnologia para escolas públicas",
        //         "description" => "O Ministério da Educação revelou um plano de R$ 2 bilhões para modernizar laboratórios de informática e implantar internet de alta velocidade em todas as escolas públicas do país até 2026.",
        //         "image" => "https://porvir-prod.s3.amazonaws.com/wp-content/uploads/2022/12/19123229/tecnologia-nas-escolas-pu%CC%81blicas-flavio-florido-educacaosp.jpg",
        //         "create_at" => new \DateTime("2025-06-18 18:23:45")
        //     ],
        //     [
        //         "title" => "Cientistas brasileiros desenvolvem vacina promissora contra dengue",
        //         "description" => "A equipe do Instituto Biomédico Nacional iniciou os testes clínicos de uma nova vacina contra dengue, com 92% de eficácia comprovada em laboratório.",
        //         "image" => "https://admin.cnnbrasil.com.br/wp-content/uploads/sites/12/2024/01/vacinadenguebutantan.jpg?w=594",
        //         "create_at" => new \DateTime("2025-06-17 09:12:30")
        //     ],
        //     [
        //         "title" => "Aplicativo de mobilidade urbana testa integração com transporte público",
        //         "description" => "Um novo recurso do app UrbanGo permite consultar rotas combinadas entre ônibus, metrô e bicicletas compartilhadas, visando facilitar a mobilidade nas grandes cidades.",
        //         "image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTJ9Cp6KpEdipK4tqRk2t5MlibqHUXtHGOfA&s",
        //         "create_at" => new \DateTime("2025-06-16 21:47:59")
        //     ],
        //     [
        //         "title" => "Nova série nacional lidera audiência nas plataformas de streaming",
        //         "description" => "A série 'Sombras do Sertão', lançada na última semana, alcançou o topo da lista das produções mais assistidas em três plataformas de streaming.",
        //         "image" => "https://midias.correiobraziliense.com.br/_midias/jpg/2022/08/09/675x450/1_so_se_for_por_amor_netflix-26196232.jpg?20220809134224?20220809134224",
        //         "create_at" => new \DateTime("2025-06-15 13:08:11")
        //     ],
        //     [
        //         "title" => "Recife sediará evento internacional de inovação e tecnologia",
        //         "description" => "A capital pernambucana receberá a 12ª edição do TechNordeste, com mais de 300 startups e palestrantes de 15 países.",
        //         "image" => "https://selesnafes.com/wp-content/uploads/2024/02/startup20.jpg",
        //         "create_at" => new \DateTime("2025-06-14 08:55:02")
        //     ],
        //     [
        //         "title" => "Estudo aponta crescimento do uso de energias renováveis no Brasil",
        //         "description" => "Segundo dados do IEMA, 47% da matriz energética nacional já provém de fontes limpas como solar e eólica, um aumento de 8% em relação ao ano anterior.",
        //         "image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRvjk626qriFaLVqrHap8w9IeRtsKjiKSPGpQ&s",
        //         "create_at" => new \DateTime("2025-06-13 16:40:17")
        //     ],
        //     [
        //         "title" => "Projeto leva oficinas de programação para comunidades carentes",
        //         "description" => "A iniciativa 'Código para Todos' está oferecendo cursos gratuitos de lógica e desenvolvimento web em mais de 30 comunidades pelo país.",
        //         "image" => "https://proximonivel.embratel.com.br/wp-content/uploads/2023/10/Internet-de-graca-nas-comunidades-de-BH_-Mais-de-200-vilas-e-favelas-da-capital-ja-contam-com-inic-750x422.jpg",
        //         "create_at" => new \DateTime("2025-06-12 11:27:36")
        //     ],
        //     [
        //         "title" => "Pesquisadores brasileiros criam plástico biodegradável à base de mandioca",
        //         "description" => "O material é 100% compostável e se decompõe em até 60 dias, sendo uma alternativa viável para reduzir o uso de plásticos convencionais.",
        //         "image" => "https://jornal.usp.br/wp-content/uploads/2019/10/20191019_ESALQ_ACOM_plastico_amidodemandica.jpg",
        //         "create_at" => new \DateTime("2025-06-11 17:15:04")
        //     ],
        //     [
        //         "title" => "Brasil estreia com vitória em campeonato mundial de robótica",
        //         "description" => "A equipe da Universidade Federal do Ceará venceu a primeira rodada da RoboCup 2025 com um sistema autônomo de resgate em áreas de risco.",
        //         "image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLP_01LjoXUoL63RcqA1asnbocLHveu83sdA&s",
        //         "create_at" => new \DateTime("2025-06-10 20:02:29")
        //     ],
        //     [
        //         "title" => "Nova lei facilita abertura de pequenas empresas digitais",
        //         "description" => "Entrou em vigor hoje a Lei do Empreendedor Digital, que simplifica tributos e reduz burocracias para desenvolvedores e startups em início de atividade.",
        //         "image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRsmzIoWRtj44pb_BwV-zXEGa5XUa960m50iQ&s",
        //         "create_at" => new \DateTime("2025-06-09 14:48:52")
        //     ]
        // ];

            return $news;
        });

        return $newsList;
    }
    
}
