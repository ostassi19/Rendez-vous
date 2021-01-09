<?php


namespace App\Security;


use App\Entity\Users;
use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserEnabledChecker implements UserCheckerInterface
{

    /**
     * @inheritDoc
     */
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof Users)
        {
            return;
        }
        if (!$user->isEnabled())
        {
            throw new DisabledException();
        }
    }

    /**
     * @inheritDoc
     */
    public function checkPostAuth(UserInterface $user)
    {
        // TODO: Implement checkPostAuth() method.
    }
}