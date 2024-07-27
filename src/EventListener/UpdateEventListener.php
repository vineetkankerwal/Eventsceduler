<?php
// src/EventListener/UpdateEventListener.php

namespace App\EventListener;

use App\Entity\EventDetails;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class UpdateEventListener implements EventSubscriberInterface
{
    private $entityManager;
    private $requestStack;

    public function __construct(EntityManagerInterface $entityManager, RequestStack $requestStack)
    {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();

        // Check if the request method is POST and contains your update form
        if ($request->isMethod('POST') && $request->request->has('update_record')) {
            // Assuming 'update_record' is the name of the button triggering the update

            $eventId = $request->request->get('event_id'); // Adjust as per your form field names
            $eventName = $request->request->get('event_name');
            $startDate = new \DateTime($request->request->get('start_date'));
            $endDate = new \DateTime($request->request->get('end_date'));
            $location = $request->request->get('location');

            // Fetch the event entity by its ID
            $event = $this->entityManager->getRepository(EventDetails::class)->find($eventId);

            if (!$event) {
                throw new NotFoundHttpException('Event not found');
            }

            // Update event details
            $event->setName($eventName);
            $event->setStartDate($startDate);
            $event->setEndDate($endDate);
            $event->setLocation($location);

            // Persist changes
            $this->entityManager->persist($event);
            $this->entityManager->flush();

           
        }
    }
}
