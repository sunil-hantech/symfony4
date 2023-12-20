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
        return new Response("future page to show {$slug}");
    }
}