<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Item;
use App\Form\ItemType;

class ItemController extends AbstractController{


    /**
     * @Route("/item" ,name="item")
     */
    public function indexAction(){

        $em= $this->getDoctrine()->getManager();

        $items = $em->getRepository(Item::class)->findAll();

        return $this->render('item/index.html.twig',['items'=>$items]);
    }
    /**
     * @Route("/item/new" ,name="item_new")
     */
    public function newAction(Request $request){

        $item = new Item();

        $form = $this->createForm(ItemType::class,$item);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
             
            $em= $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();

            return $this->render('item/index.html.twig');
        }

        return $this->render('item/new.html.twig', array('form' => $form->createView()));

    }
}