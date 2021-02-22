<?php

namespace App\Controller;

use App\Entity\Fiche;
use App\Form\FicheType;
use App\Repository\FicheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/fiche")
 */
class FicheController extends AbstractController
{
    /**
     * @Route("/{idMedecin}/_", name="fiche_index_med", methods={"GET"})
     */
    public function index($idMedecin, FicheRepository $ficheRepository): Response
    {
        return $this->render('fiche/index.html.twig', [
            'fiches' => $ficheRepository->findBy(['medecin' => $idMedecin]),
        ]);
    }

    /**
     * @Route("/new", name="fiche_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $data = $request->query->all();
        $patient = $this->getDoctrine()->getRepository('App:Patient')->find($data[1]);
        $medecin = $this->getDoctrine()->getRepository('App:Medecin')->find($this->getUser()->getIdPersonne());
        //var_dump($medecin->getId());die();
        $fiche = new Fiche();
        $form = $this->createForm(FicheType::class, $fiche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $fiche->setCreatedAt(new \DateTime())->setIsDeleted(false);
            $fiche->setPatient($patient)->setMedecin($medecin);
            //var_dump($fiche);die();
            $entityManager->persist($fiche);
            $entityManager->flush();

            return $this->redirectToRoute('fiche_show_med', array(
                'id' => $patient->getId(), 'idMedecin' => $medecin->getId()));
        }

        return $this->render('fiche/new.html.twig', [
            'fiche' => $fiche,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fiche_show", methods={"GET"})
     */
    public function show(Fiche $fiche): Response
    {
        return $this->render('fiche/show.html.twig', [
            'fiche' => $fiche,
        ]);
    }

    /**
     * @Route("/{id}/med/{idMedecin}", name="fiche_show_med", methods={"GET"})
     */
    public function showFich_Med($id, $idMedecin, FicheRepository $ficheRepository): Response
    {
        $fiche = $ficheRepository->findOneBy(['patient' => $id, 'medecin' => $idMedecin]);
        //dump($fiche);die();
        return $this->render('fiche/show.html.twig', [
            'fiche' => $fiche,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="fiche_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Fiche $fiche): Response
    {
        $form = $this->createForm(FicheType::class, $fiche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fiche_index_med', ['idMedecin' => $this->getUser()->getIdPersonne()]);
        }

        return $this->render('fiche/edit.html.twig', [
            'fiche' => $fiche,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fiche_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Fiche $fiche): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fiche->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fiche);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fiche_index');
    }
}
