<?php


namespace App\Controller;


use App\Entity\Medecin;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class medecinController extends Controller
{

    /**
     * @Route("medecin", name="medecin-accueil")
     */
    public function base (){

        //var_dump($this->getUser()->getIdPersonne());die();
        $id = $this->getUser()->getIdPersonne();
        $em = $this->getDoctrine()->getManager();
        $medecin = $em->getRepository('App:Medecin')->find($id);

        if ($medecin instanceof Medecin){
            $rvs = new ArrayCollection();
            foreach ($medecin->getFiches() as $key => $fiche){
                foreach ($fiche->getRendezVouses() as $rv)
                    //
                    $rvs->add($rv);
            }
            //var_dump($rvs);die();
            /*foreach ($rvs as $rv){
              echo $rv->getFiche()->getPatient()->getNom(); die();
            }*/
        }
        /*foreach ($medecins as $medecin){
           dump( $medecin->getContact()->getEmail());die();
        }
        dump($medecins);die();
*/
        return $this->render('base_medecin.html.twig', array(
            'Medecin' => $medecin,
            'rvs' => $rvs
        ));
    }
}