<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Author;
use App\Form\AuthorType;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthorController extends AbstractController
{

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Route("/author", name="author")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $authors = $em->getRepository(Author::class)->findAll();
        return $this->render('Author/index.html.twig', [
            'authors' => $authors,
        ]);
    }

    /**
     * @Route("/author/new" , name="author_new")
     */

    public function newAction(Request $request){

        $author = new Author();

       
       
        $form = $this->createForm(AuthorType::class,$author);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
             
            $em= $this->getDoctrine()->getManager();
            $em->persist($author);
            $em->flush();
            

            return $this->redirectToRoute('author');
        }
        
            return $this->render('author/new.html.twig', array('form' => $form->createView()));
        

    }

    /**
     * @Route("/author/delete" ,name="author_delete")
     */
    public function deleteAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $author = $em->getRepository(Author::class)->find($request->get('id'));

        
        $em->remove($author);
        $em->flush();


        return new JsonResponse();
    }


        

    
}
