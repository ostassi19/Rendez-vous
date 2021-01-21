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

        $user = new Users();

        //$user->setSalt(md5(time()));
        $pass = $this->passwordEncoder->encodePassword($user, '123');
        $user->setEmail('eddine.aa@gmail.com');
        $user->setPassword($pass)->setName('amani')->setRoles(['ROLE_SUPERADMIN'])
            ->setIdPersonne(1)->setUsername('amani');
        $user->setEnabled(1); //enable or disable

        $em = $this->getDoctrine()->getManager();
        //$em->persist($user);
        //$em->flush();

        //return new Response('Sucessful');
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $session = $this->get('session')->get('_router__');
        echo $session;
        $error = $authenticationUtils->getLastAuthenticationError();
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
