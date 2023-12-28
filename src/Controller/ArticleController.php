<?php

namespace  App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Service\MarkdownHelper;
use App\Service\SlackClient;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ArticleController extends AbstractController
{

    private $isDebug;
    public function __construct(bool $isDebug)
    {
        $this->isDebug = $isDebug;
    }

    /**
     * @Route("/",name="app_homepage")
     */
    public function homepage(ArticleRepository $repository)
    {
        // $repository=$em->getRepository(Article::class);

        // dump($repository);die();
        // $articles=$repository->findAll();
        // $articles=$repository->findBy([],['publishedAt'=>'DESC']);
         $articles=$repository->findAllPublishedOrderedByNewest();

        return $this->render("article/homepage.html.twig", [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/news/{slug}",name="article_show")
     */
    // public function show($slug,Environment $twigEnvironment)
    public function show(Article $article,SlackClient $slack)
    {   


        if ($article->getSlug() === 'SlackMessage') {
            $slack->sendMessage('Sunil', 'Hey there!,this is slack service2');
        }

        $comments = [
            'Lorem ipsum, dolor sit amet consectetur adipisicing elit.',
            'Omnis ducimus quae odit maxime nemo quo aperiam aut',
            'accusantium amet dolore ab et molestiae alias tempore harum, distinctio fugit cupiditate ipsa!'
        ];



// $articleContent = $markdownHelper->parse($articleContent);


        return $this->render('article/show.html.twig', [
           'article'=>$article,
            'comments' => $comments
        ]);


        // $html=$twigEnvironment->render('article/show.html.twig',[
        //     'title'=>ucwords(str_replace("-"," ",$slug)),
        //     'slug'=>$slug,
        //     'comments'=>$comments
        // ]);

        // return new Response($html);
    }

    /**
     * @Route("/news/{slug}/heart",name="article_toggle_heart",methods={"POST"})
     */
    public function toggleArticleHeart(Article $article, LoggerInterface $logger,EntityManagerInterface $em)
    {
        
        $article->incrementHeartCount();
        $em->flush();
        $logger->info("Article is being hearted");
        return new JsonResponse(['hearts' => $article->getHeartCount()]);
    }
}
