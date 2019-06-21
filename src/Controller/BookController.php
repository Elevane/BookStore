<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Book;
use App\Form\BookType;

class BookController extends AbstractController{


    /**
     * @Route("/index")
     */
    public function indexAction(){

        $em= $this->getDoctrine()->getManager();

        $books = $em->getRepository(Book::class)->findAll();

        return $this->render('index/index.html.twig',['books'=>$books]);
    }
    /**
     * @Route("/index/new")
     */
    public function newAction(Request $request){

        $book = new Book();

        $form = $this->createForm(BookType::class,$book);

        if($form->isSubmitted() && $form->isValid()){
            $form->handleRequest($request); 
            $em= $this->getDoctrine()->getManager();
            $em->persist($form);
            $em->flush();

            return $this->render('index/index.html.twig');
        }

        return $this->render('index/new.html.twig', array('form' => $form->createView()));

    }
}