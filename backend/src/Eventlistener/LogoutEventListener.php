<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Event\LogoutEvent;

#[AsEventListener(event: LogoutEvent::class)]
class LogoutEventListener
{
    public function __invoke(LogoutEvent $event): void
    {
        // Vérifier que c'est bien une requête API (commence par /api)
        if (str_starts_with($event->getRequest()->getPathInfo(), '/api')) {
            $response = new JsonResponse([
                'success' => true,
                'message' => 'Déconnexion réussie'
            ], 200);

            $event->setResponse($response);
        }
    }
}