<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Book;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\BookType;

class BookController extends AbstractController{

    /**
     * @Route("/book", name="book")
     */
    public function indexAction(){
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository(Book::class)->findAll();
        return $this->render('Book/index.html.twig', array('books'=> $books));
    }

    /**
     * @Route("/book/new", name="book_new")
     */
    public function newAction(Request $request){
        
        $em = $this->getDoctrine()->getManager();
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em->persist($book);
            $em->flush();

            return $this->render('Book/index.html.twig');
        }

        return $this->render('Book/new.html.twig',array('form'=> $form->createView()));
    }
}