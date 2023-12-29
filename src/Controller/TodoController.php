<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Repository\TodoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    /**
     * @Route("/todo", name="app_todo")
     */
    public function index(TodoRepository $respository): Response
    {
        $todos=$respository->findAll();

        // echo "<pre>";
        // print_r($todos);
        // echo "</pre>";
        // die();
        return $this->render('todo/index.html.twig', [
            'todos' => $todos,
        ]);
    }

    /**
     * @Route("/todo/save", name="saveTodo")
     */
    public function save(EntityManagerInterface $em)
    {
       $todo=new Todo();
       $todo->setTile($_POST['title']);
       $todo->setDescription($_POST['description']);
       $em->persist($todo);
       $em->flush();
       return $this->redirectToRoute('app_todo');
    }

     /**
     * @Route("/todo/save/{todo}", name="updateTodo")
     */
    public function update(Todo $todo,EntityManagerInterface $em)
    {
        $todo->setTile('Title from load fixture 3 updated..');
        $em->flush();
        return $this->redirectToRoute('app_todo');
    }
}
