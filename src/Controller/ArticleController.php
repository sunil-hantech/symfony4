<?php

namespace  App\Controller;

use App\Service\MarkdownHelper;
use App\Service\SlackClient;
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
    public function show($slug,MarkdownHelper $markdownHelper,SlackClient $slack)
    {

        if ($slug === 'SlackMessage') {
            $slack->sendMessage('Sunil', 'Hey there!,this is slack service2');
        }

        $comments = [
            'Lorem ipsum, dolor sit amet consectetur adipisicing elit.',
            'Omnis ducimus quae odit maxime nemo quo aperiam aut',
            'accusantium amet dolore ab et molestiae alias tempore harum, distinctio fugit cupiditate ipsa!'
        ];

        // dump($this->isDebug);die;

        $articleContent = <<<wtf
Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow **turkey** shank eu pork belly meatball non cupim.

Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder, capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham.
Adipisicing picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt occaecat lorem meatball prosciutto quis strip steak.
Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck fugiat.
wtf;



$articleContent = $markdownHelper->parse($articleContent);

        // echo $message;


        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace("-", " ", $slug)),
            'articleContent' => $articleContent,
            'slug' => $slug,
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
