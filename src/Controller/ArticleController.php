<?php
namespace  App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
class ArticleController extends AbstractController
{
   /**
    * @Route("/")
    */
    public function homepage()
    {
       return new Response("hello world");
    }

    /**
     * @Route("/news/{slug}")
     */
    public function show($slug)
    {
        $comments=[
            'Lorem ipsum, dolor sit amet consectetur adipisicing elit.',
        'Omnis ducimus quae odit maxime nemo quo aperiam aut',
        'accusantium amet dolore ab et molestiae alias tempore harum, distinctio fugit cupiditate ipsa!'
    ]; 


    

        return $this->render('article/show.html.twig',[
            'title'=>ucwords(str_replace("-"," ",$slug)),
            'comments'=>$comments
        ]);
    }
}