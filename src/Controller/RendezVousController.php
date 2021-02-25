<?php

namespace App\Controller;

use App\Entity\Fiche;
use App\Entity\Patient;
use App\Entity\RendezVous;
use App\Entity\Users;
use App\Form\RendezVousType;
use App\Repository\FicheRepository;
use App\Repository\RendezVousRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @Route("/rendez/vous")
 */
class RendezVousController extends AbstractController
{
    /**
     * @Route("/{idMedecin}/_", name="rendez_vous_index", methods={"GET"})
     */
    public function index(RendezVousRepository $rendezVousRepository, $idMedecin, FicheRepository $ficheRepository): Response
    {
        $fiches = $ficheRepository->findBy(['medecin' => $idMedecin]);
        $rvs = new ArrayCollection();
        foreach ($fiches as $key => $fiche){
            foreach ($fiche->getRendezVouses() as $rv)
            //
                $rvs->add($rv);
        }
        //dump($rvs); die();
        return $this->render('rendez_vous/index.html.twig', [
            'rendez_vouses' => $rvs,
        ]);
    }

    /**
     * @Route("/{idMedecin}/patient/{idPatient}", name="rendez_vous_patient", methods={"GET"})
     */
    public function PatientRv($idPatient, $idMedecin): Response
    {
//onclick="liste({{ app.user.idPersonne }},{{ med.id }})"
        if($this->getUser()->getIdPersonne()== $idPatient){

            $Fiche = $this->getDoctrine()->getRepository('App:Fiche')->findOneBy(
                ['patient' => $idPatient,'medecin' => $idMedecin]
            );
        }
        else{
            $Fiche = $this->getDoctrine()->getRepository('App:Fiche')->findOneBy(
                ['patient' => $idPatient, 'medecin' => $this->getUser()->getIdPersonne()]);
        }

        $rvs = $Fiche->getRendezVouses();
        $dates = $this->getDoctrine()->getManager()->getRepository('App:Date')->findAll();
        return $this->render('rendez_vous/index.html.twig', [
            'rendez_vouses' => $rvs,
            'idPatient' => $idPatient,
            'Dates' => $dates
        ]);
    }

    /**
     * @Route("/libre", name="rv-libre")
     */
    public function RendezVousLibre(Request $request){

        $data = $request->query->all();
        $rvs = $this->getDoctrine()->getRepository('App:RendezVous')->findBy([
            'fiche' => null,
            'date' => $data['date']
        ]);
        return $this->render('rendez_vous/heure-rendez-vous.html.twig',
        [
            'rvs' => $rvs
        ]);
    }

    /**
     * @Route("/modifier/{idRv}/{idDate}", name="edit-libre")
     */
    public function Modifier($idRv, $idDate){

        $em = $this->getDoctrine()->getManager();
        $date = $em->getRepository('App:Date')->find($idDate);
        $rv = $em->getRepository('App:RendezVous')->find($idRv);

        $fiche =$em->getRepository('App:Fiche')->findOneBy([
            'medecin' => $date->getMedecin()->getId(),
            'patient' => $this->getUser()->getIdPersonne()
        ]);

        $rv->setFiche($fiche);
        $em->flush();

        return new Response('Done');
    }

    /**
     * @Route("/new/{idPatient}", name="rendez_vous_new", methods={"GET","POST"})
     */
    public function new($idPatient, Request $request): Response
    {
        $rendezVou = new RendezVous();

        $form = $this->createForm(RendezVousType::class, $rendezVou);
        $form->handleRequest($request);
        $roles = $this->getUser()->getRoles();
        $session = $this->get('session');
        $idMed= $session->get('_idMedicien__');

        //dump($idMed, $idPatient) ; die();
        //$idPatient = 40;
        //var_dump($roles[0] ,  Users::ROLE_PATIENT[0], $roles[0] == Users::ROLE_PATIENT);die();
        if ($roles[0] == Users::ROLE_PATIENT[0]){
            $idPatient = $this->getUser()->getIdPersonne();
            $fiche= new Fiche();
            $patient= $this->getDoctrine()->getRepository('App:Patient')->find($idPatient);
            $fiche->setPatient($patient);
            $medecin = $this->getDoctrine()->getRepository('App:Medecin')->find($idMed);
            $fiche->setMedecin($medecin);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fiche);
            $entityManager->flush();
        }
        $fiche = $this->getDoctrine()->getRepository('App:Fiche')->findOneBy(
            ['medecin' => $idMed, 'patient' => $idPatient]);

        //dump($fiche->getPatient()->getNom());die();
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $rendezVou->setFiche($fiche)->setCreatedAt(new \DateTime());
            //var_dump($fiche->getPatient()->getNom());
            $entityManager->persist($rendezVou);
            $entityManager->flush();
            //$this->addFlash('success', 'Article Created! Knowledge is power!');
            //$request->getSession()->getFlashBag()->add("susss");
            return $this->redirectToRoute('accueil');
        }

        return $this->render('rendez_vous/new.html.twig', [
            'rendez_vou' => $rendezVou,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/ajouter", name="rendez_vous_ajouter", methods={"GET","POST"})
     */
    public function add(Request $request): Response
    {
        $user = $this->getUser();
        //retourne le route existant rendez_vous_ajouter
        $router = $request->attributes->get('_route');
        //echo $router;
        $data = $request->query->all();
        //echo $data;
        $idmedecien = $data ? $data['id_medecien'] : 0;
        //dump($idmedecien) ;

        //echo $session->get('_router__');

        if ($idmedecien > 0){
            $session = $this->get('session');
            $session->set('_idMedicien__', $idmedecien);
        }
        //S'il ya un utilisateur connecté alors la fonction retourne 1 sinon elle retourne 0
        if ($user == null){
            // y a pas un utilisateur connecté
// recherch !!!!
            $session = $this->get('session');

            //echo '<pre>' . var_export($session, true) . '</pre>'; die();
            // recherch !!!!
            $session->set('_router__', $router);
            echo  $session->get('_router__') .' // ';
            // recherch !!!!
            $session->set('_idMedicien__', $idmedecien);
            echo ' __Medecin : '.$session->get('_idMedicien__').' // ';
            // recherch !!!!
            $session->set('_role__', $data ? $data['role'] : 0);
            echo $session->get('_role__');

            return new Response(0);
        } else {
            return new Response(1);
        }
    }

    /**
     * @Route("/{id}", name="rendez_vous_show", methods={"GET"})
     */
    public function show(RendezVous $rendezVou): Response
    {
        return $this->render('rendez_vous/show.html.twig', [
            'rendez_vou' => $rendezVou,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rendez_vous_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RendezVous $rendezVou): Response
    {
        $form = $this->createForm(RendezVousType::class, $rendezVou);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rendez_vous_index');
        }

        return $this->render('rendez_vous/edit.html.twig', [
            'rendez_vou' => $rendezVou,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rendez_vous_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RendezVous $rendezVou): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rendezVou->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rendezVou);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rendez_vous_index');
    }
}
