<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Typeitem;
use App\Form\typeItemType;

class TypeItemController extends AbstractController
{
    /**
     * @Route("/typeItem", name="type_item")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $typesItem = $em->getRepository(Typeitem::class)->findAll();
        return $this->render('typeItem/index.html.twig', [
            'typesItem' => $typesItem,
        ]);
    }

    /**
     * @Route("/typeItem/new" , name="typeItem_new")
     */

    public function newAction(Request $request){

        $typeItem = new Typeitem();

        $form = $this->createForm(typeItemType::class,$typeItem);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
             
            $em= $this->getDoctrine()->getManager();
            $em->persist($typeItem);
            $em->flush();

            return $this->render('typeItem/index.html.twig');
        }

        return $this->render('typeItem/new.html.twig', array('form' => $form->createView()));


    }

    /**
     * @Route("/typeItem/delete/{id}" ,name="typeItem_delete")
     */
    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();

        $typeItem = $em->getRepository(Typeitem::class)->find($id);

        
        $em->remove($typeItem);
        $em->flush();

        return $this->render('typeItem/index.html.twig');
    }


        

    
}
