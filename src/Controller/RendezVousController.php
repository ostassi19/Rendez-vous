<?php

namespace App\Controller;

use App\Entity\RendezVous;
use App\Form\RendezVousType;
use App\Repository\FicheRepository;
use App\Repository\RendezVousRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/{idPatient}/patient", name="rendez_vous_patient", methods={"GET"})
     */
    public function PatientRv($idPatient): Response
    {
        $Fiche = $this->getDoctrine()->getRepository('App:Fiche')->findOneBy(
            ['patient' => $idPatient, 'medecin' => $this->getUser()->getIdPersonne()]);

        $rvs = $Fiche->getRendezVouses();

        return $this->render('rendez_vous/index.html.twig', [
            'rendez_vouses' => $rvs,
        ]);
    }

    /**
     * @Route("/new", name="rendez_vous_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $rendezVou = new RendezVous();
        $form = $this->createForm(RendezVousType::class, $rendezVou);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rendezVou);
            $entityManager->flush();

            return $this->redirectToRoute('rendez_vous_index');
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

        $router = $request->attributes->get('_route');

        $data = $request->query->all();

        $idmedecien = $data ? $data['id_medecien'] : 0;

        //echo $session->get('_router__');
        if ($idmedecien > 0){

        }
        if ($user == null){

            $session = $this->get('session');
            $session->set('_router__', $router);
            $session->set('_idMedicien__', $idmedecien);
            $session->set('_role__', $data ? $data['role'] : 0);

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
