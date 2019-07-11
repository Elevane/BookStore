<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Image;
use App\Form\ImageType;
use Symfony\Component\HttpFoundation\JsonResponse;

class ImageController extends AbstractController{


    /**
     * @Route("/image", name="image")
     */

     public function indexAction(){
        $em = $this->getDoctrine()->getManager();

        $images = $em->getRepository(Image::class)->findAll();
        
        return $this->render('image/index.html.twig', array('images'=> $images));
     }

     /**
      * @Route("/image/new", name="image_new")
      */
    public function newAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $image= new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($image);
            $em->flush();

            return $this->redirectToRoute('image');
        }

        return $this->render('image/new.html.twig', array('form'=>$form->createView()));
    }
    /**
     * @Route("/image/uploadFile", name="image_uploadFile")
     */
    public function UploadFile(Request $request){

        $file = $request->files->get('file');

        // If a file was uploaded
        if(!is_null($file)){
            // generate a random name for the file but keep the extension
            $em = $this->getDoctrine()->getManager();
            $images = $em->getRepository(Image::class)->findAll();
            $max = count($images) + 1;
            $filename = $max.".".$file->getClientOriginalExtension();
            $path = "./import/img/";
            $file->move($path,$filename); // move the file to a path
           
            $image= new Image();
           
            $image->setName($filename);
            $image->setPath($path.$filename);

            return new JsonResponse(array('id'=>$image->getId('id'), 'name'=>$image->getName(),'path' => $image->getPath()));
        }

        


    }
}