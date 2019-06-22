<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Genre;
use App\Form\GenreType;
use App\Entity\Typeitem;

class GenreController extends AbstractController
{
    /**
     * @Route("/genre", name="genre")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $typesItem = $em->getRepository(Genre::class)->findAll();
        return $this->render('Genre/index.html.twig', [
            'typesItem' => $typesItem,
        ]);
    }

    /**
     * @Route("/genre/new" , name="genre_new")
     */

    public function newAction(Request $request){

        $genre = new Genre();

        $form = $this->createForm(GenreType::class,$genre);
        
        if($request){
             
            $em= $this->getDoctrine()->getManager();
            $typeItem = $em->getRepository(Typeitem::class)->find($request->get('id'));
            $genre->setName($request->get('name'));
            $genre = $em->getRepository(Genre::class)->find($typeItem);
            $em->persist($genre);
            $em->flush();

            return $this->render('genre/index.html.twig');
        }

        return $this->render('genre/new.html.twig', array('form' => $form->createView()));


    }

    /**
     * @Route("/genre/delete/{id}" ,name="genre_delete")
     */
    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();

        $genre = $em->getRepository(Genre::class)->find($id);

        
        $em->remove($genre);
        $em->flush();

        return $this->render('genre/index.html.twig');
    }


        

    
}
