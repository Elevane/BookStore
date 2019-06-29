<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Genre;
use App\Form\GenreType;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class GenreController extends AbstractController
{

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Route("/genre", name="genre")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $genres = $em->getRepository(Genre::class)->findAll();
        return $this->render('Genre/index.html.twig', [
            'genres' => $genres,
        ]);
    }

    /**
     * @Route("/genre/new" , name="genre_new")
     */

    public function newAction(Request $request){

        $genre = new Genre();

       
       
        $form = $this->createForm(GenreType::class,$genre);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
             
            $em= $this->getDoctrine()->getManager();
            $em->persist($genre);
            $em->flush();
            
            return $this->render('genre/index.html.twig');
        }

        return $this->render('genre/new.html.twig', array('form' => $form->createView()));


    }

    /**
     * @Route("/genre/delete" ,name="genre_delete")
     */
    public function deleteAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $genre = $em->getRepository(Genre::class)->find($request->get('id'));

        
        $em->remove($genre);
        $em->flush();

        $genres = $em->getRepository(Genre::class)->findAll();

        return new JsonResponse();
    }


        

    
}
