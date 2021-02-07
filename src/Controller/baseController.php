<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class baseController extends Controller
{
    /**
     * @Route("/accueil")
     */
    public function base (){

        //var_dump($this->getUser());die();
        $em = $this->getDoctrine()->getManager();
        $medecins =  $em->getRepository('App:Medecin')->findAll();

        $roles = $this->getUser()->getRoles();
        if ($roles[0] == 'ROLE_MEDECIN'){
            return $this->redirect('medecin');
        } else {
            return $this->render('base2.html.twig', array(
                'Medecins' => $medecins
            ));
        }
    }

}