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
    public function base()
    {

        $id = $this->getUser()->getIdPersonne();
        $em = $this->getDoctrine()->getManager();
        $medecin = $em->getRepository('App:Medecin')->find($id);
        /*cherche si le medecin connecté se trouve dans la base médecin
        if ($medecin instanceof Medecin){
            // liste des rendez-vous d'un medecin
            $rvs = new ArrayCollection();
            // liste des fiches d'un medecin
            foreach ($medecin->getFiches() as $key => $fiche)
                //liste des rendez_vous dans un fiche
                foreach ($fiche->getRendezVouses() as $rv)
                    //ajouter les rendez-vous d'un fiche donnée dans la table de type arrayCollection
                    $rvs->add($rv);
            }
        }*/
        $d = $em->getRepository('App:Date')->findOneBy([
            'date' => new \DateTime(),
            'medecin' => $this->getUser()->getIdPersonne()]);
        if ($d != null){
        $rvs = $d->getRendezVouses();
        //la fonction va etre applicable dans base-medecin.html.twig en récupérant deux variables (Medecin, rvs)
        return $this->render('base_medecin.html.twig', array(
            'Medecin' => $medecin,
            'rvs' => $rvs
        ));}
        else return $this->render('base_medecin.html.twig', array(
            'Medecin' => $medecin,
            'rvs' => null
        ));
    }
}