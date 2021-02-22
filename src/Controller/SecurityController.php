<?php

namespace App\Controller;

use App\Entity\Users;
use App\Security\TokenGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {

        $em = $this->getDoctrine()->getManager();

        try {
            $roles = $this->getUser() ? $this->getUser()->getRoles() : null;
            if($roles[0] == 'ROLE_SUPERADMIN'){
                return $this->redirect('easyadmin');
            }
            elseif ($roles[0] == 'ROLE_MEDECIN'){
                return $this->redirect('medecin');}
                elseif ($roles[0] == 'ROLE_PATIENT')
                return $this->redirect('accueil');
            }
        catch (\Exception $exception){

        }

        $session = $this->get('session')->get('_router__');
        //echo $session;
        $error = $authenticationUtils->getLastAuthenticationError();
        var_dump($error ? $error->getMessage(): '');
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
