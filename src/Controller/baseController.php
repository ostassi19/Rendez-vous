<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class baseController extends Controller
{
    /**
     * @Route("base")
     */
    public function base (){

        $em = $this->getDoctrine()->getManager();
        $medecins =  $em->getRepository('App:Medecin')->findAll();
        /*foreach ($medecins as $medecin){
           dump( $medecin->getContact()->getEmail());die();
        }
        dump($medecins);die();
*/
        return $this->render('base2.html.twig', array(
            'Medecins'=>$medecins
        ));
    }

}