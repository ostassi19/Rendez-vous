<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Form\PatientType;
use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/patient")
 */
class PatientController extends AbstractController
{
    /**
     * @Route("/", name="patient_index", methods={"GET"})
     */
    public function index(PatientRepository $patientRepository): Response
    {
        //contient le medecin déja connecté
        $medecin = $this->getDoctrine()->getRepository('App:Medecin')->find($this->getUser()->getIdPersonne());
        // contient les fiches d'un medecin
        $fiches = $medecin->getFiches();
        //declaration d'un tableau patient
        $patients = new ArrayCollection();
        //ajouter un patient pour chaque fiche
        foreach ($fiches as $fiche){
            $patients->add($fiche->getPatient());
        }
//        dump($patients); die();
        // la fonction va etre appliquer dans le ficher patient/index.html.twig en recupérants tous les patient d'un médecin
        // qui ont déja une ficher
        return $this->render('patient/index.html.twig', [
            'patients' => $patients,
        ]);
    }

    /**
     * @Route("/new", name="patient_new", methods={"GET","POST"})
     */
    //fonction qui permet la création d'un patient
    public function new(Request $request): Response
    {
        //instance de la table patient
        $patient = new Patient();
        //R2CUP2RATION TOUS LES ATTRIBUTS DE PATIENT
        $form = $this->createForm(PatientType::class, $patient);
        // permet de gérer le traitement de la saisie du formulaire
        $form->handleRequest($request);

        //var_dump($form->isValid(), $patient);die();
        //permet de savoir si le formulaire a été saisi et si de plus les règles de validations sont vérifiée
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            // persistance de l'entité patient dans manager
            $entityManager->persist($patient);
            $entityManager->flush();
            // si le fomulaire a été envoyer avec succé et les données sont enregistrer dans la base alors on aura une redirection
            // à la page de création d'un ficher qui va etre responsable à la création d'une fiche pour ce patient
            return $this->redirectToRoute('fiche_new', ['patient', $patient->getId()]);
        }
        // la fonction va etre applicable dans patient/new.html.twig en récupérant deux variables (patient qui a été créer
        // et la création de vue de formulaire)
        return $this->render('patient/new.html.twig', [
            'patient' => $patient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/ajouter", name="patient_ajouter", methods={"GET","POST"})
     */
    public function ajouter(Request $request): Response
    {
        $patient = new Patient();

        return $this->render('patient/ajouter.html.twig', [
            'patient' => $patient,
            //'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="patient_show", methods={"GET"})
     */
    public function show(Patient $patient): Response
    {
        return $this->render('patient/show.html.twig', [
            'patient' => $patient,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="patient_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Patient $patient): Response
    {
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('patient_index');
        }

        return $this->render('patient/edit.html.twig', [
            'patient' => $patient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="patient_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Patient $patient): Response
    {
        if ($this->isCsrfTokenValid('delete'.$patient->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($patient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('patient_index');
    }
}
