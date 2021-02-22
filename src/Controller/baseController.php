<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class baseController extends Controller
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function base (){

        //var_dump($this->getUser());die();

        $roles = $this->getUser() ? $this->getUser()->getRoles() : null;
        if ($roles[0] == 'ROLE_MEDECIN'){
            return $this->redirect('medecin');
        }
        else {
            $em = $this->getDoctrine()->getManager();
            $medecins =  $em->getRepository('App:Medecin')->findAll();
            $dates = $em->getRepository('App:Date')->findAll();

            return $this->render('base2.html.twig', array(
                'Medecins' => $medecins,
                'Dates' => $dates
            ));
        }

    }
    /**
     * @Route("/apropos", name="apropos")
     */
    public function aprops(){
        return $this->render('apropos.html.twig');
    }

}