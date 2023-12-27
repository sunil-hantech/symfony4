<?php

namespace  App\Controller;

use App\Entity\Article;
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
    public function homepage()
    {
        return $this->render("article/homepage.html.twig");
    }

    /**
     * @Route("/news/{slug}",name="article_show")
     */
    // public function show($slug,Environment $twigEnvironment)
    public function show($slug,MarkdownHelper $markdownHelper,SlackClient $slack,EntityManagerInterface $em)
    {   


        if ($slug === 'SlackMessage') {
            $slack->sendMessage('Sunil', 'Hey there!,this is slack service2');
        }

        $repository = $em->getRepository(Article::class);

         /** @var Article $article */
        $article = $repository->findOneBy(['slug' => $slug]);

        // echo "<pre>";
        // print_r($article);
        // echo "</pre>";
        // die();
        // dump($article);die;

        if (!$article) {
            throw $this->createNotFoundException(sprintf('No article for slug "%s"', $slug));
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
    public function toggleArticleHeart($slug, LoggerInterface $logger)
    {
        $logger->info("Article is being hearted {$slug}");
        return new JsonResponse(['hearts' => rand(5, 100)]);
    }
}
