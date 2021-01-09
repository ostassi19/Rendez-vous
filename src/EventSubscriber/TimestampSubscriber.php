<?php


namespace App\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Secretaire;
use App\Entity\Medecin;
use App\Entity\Patient;
use App\Entity\Adresse;
use App\Entity\Contact;
use App\Entity\Users;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class TimestampSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
          KernelEvents::VIEW => ['prePersist', EventPriorities::PRE_WRITE]
        ];
    }

    public function prePersist (GetResponseForControllerResultEvent $event)
    {
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ((!$entity || $entity instanceof Users || $entity instanceof Medecin
                || $entity instanceof Patient || $entity instanceof Secretaire
				|| $entity instanceof Adresse || $entity instanceof Contact)
                || Request::METHOD_POST !== $method)
        {
            return;
        }
        $entity->prePersist();
    }
}