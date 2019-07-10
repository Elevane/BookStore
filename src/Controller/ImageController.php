<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Image;

use Symfony\Component\HttpFoundation\JsonResponse;

class ImageController extends AbstractController{

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
            $em->persist($image);
            $em->flush();


            return new JsonResponse(array('id'=>$image->getId('id'), 'name'=>$image->getName(),'path' => $image->getPath()));
        }

        


    }
}