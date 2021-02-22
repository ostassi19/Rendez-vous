<?php


namespace App\EventSubscriber;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class onAuthenticationSuccess
{
    public function authentication_success(Request $request, TokenInterface $token)
    {
        // handle it and return a response
    }
}