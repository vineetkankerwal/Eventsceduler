<?php
namespace App\Controller;
use App\Form\EventType;
use App\Entity\EventDetails;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\EventDetailsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;
class MyEventsController extends AbstractController
{
  private $em;
  public function __construct(EntityManagerInterface $em)
  {
      $this->em = $em;
  }
    
   
    
  #[Route('/myEvents', name: 'app_my-events')]
  public function addEvent(ManagerRegistry $doctrine, Request $request, EntityManagerInterface $em): Response
  {
      $user = $this->getUser();
      $event = new EventDetails();
      $event->setName(''); 
      $event->setStartDate(new \DateTime()); 
      $event->setEndDate(new \DateTime()); 
      $event->setLocation(''); 
          
      $form = $this->createForm(EventType::class, $event);
      $form->handleRequest($request);
      
      // List of events
      $events = $doctrine->getRepository(EventDetails::class)->findAll();
      //event with email
     
 
      // Handle form submission for adding new event
      if ($form->isSubmitted() && $form->isValid()) {
          $startDate = $event->getStartDate();
          $endDate = $event->getEndDate();
  
          // Check if the start date or end date is in the past
          if ($startDate < new \DateTime()) {
              $this->addFlash('error', 'Start date cannot be in the past.');
              return $this->redirectToRoute('app_my-events');
          }
          
          if ($endDate < new \DateTime()) {
              $this->addFlash('error', 'End date cannot be in the past.');
              return $this->redirectToRoute('app_my-events');
          }
  
          $em->persist($event);
          $em->flush();
  
          return $this->redirectToRoute('app_my-events');
      }
  
      // Create forms for updating existing events
      $eventForms = [];
      foreach ($events as $eventItem) {
          $eventForm = $this->createForm(EventType::class, $eventItem);
          $eventForms[$eventItem->getId()] = $eventForm->createView();
      }
  
      return $this->render('MyEvents/MyEvents.html.twig', [
          'events' => $events,
          'form' => $form->createView(),
          'eventForms' => $eventForms,
      ]);
  }
  

   
 
 //for update the event
  #[Route('/event/update/{id}', name: 'app_event_update')]
    public function updateEvent(Request $request, ManagerRegistry $doctrine, $id): Response
    {
       $entityManager = $doctrine->getManager();
        $event = $doctrine->getRepository(EventDetails::class)->find($id);

        if (!$event) {
            throw $this->createNotFoundException('No event found for id ' . $id);
        }

        $form =  $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_my-events');
        }

        return $this->render('MyEvents/update_event.html.twig', [
            'form' => $form->createView(),
        ]);
    }



  
    //for delete an event
    #[Route("/events/{id}", name:"delete_event")]
    public function deleteEvent(ManagerRegistry $doctrine,EventDetails $event,EntityManagerInterface $em,int $id): Response
    {
      $event = new EventDetails();
      $events =$em->getRepository(EventDetails::class)->find($id);
        $em->remove($events);
        $em->flush();

  
        return $this->redirectToRoute('app_my-events',[
          'id' =>$events->getId(),
        ]);
    }

    //filter
    #[Route("/events", name:"event_list")]

    public function list(EventDetailsRepository $eventRepository, Request $request): Response
    {
        $startDate = $request->query->get('StartDate');
        $endDate = $request->query->get('EndDate');

        // Validate dates
        $validator = Validation::createValidator();
        $startDateConstraint = new Assert\Date();
        $endDateConstraint = new Assert\Date();

        $startDateViolations = $validator->validate($startDate, $startDateConstraint);
        $endDateViolations = $validator->validate($endDate, $endDateConstraint);

        if (0 === count($startDateViolations) && 0 === count($endDateViolations)) {
            $startDateTime = new \DateTime($startDate);
            $endDateTime = new \DateTime($endDate);
            $events = $eventRepository->findByDateRange($startDateTime, $endDateTime);
        } else {
            if (count($startDateViolations) > 0) {
                $this->addFlash('error', 'Invalid start date format.');
            }
            if (count($endDateViolations) > 0) {
                $this->addFlash('error', 'Invalid end date format.');
            }
            $events = $eventRepository->findAll();
        }

        return $this->render('MyEvents/list.html.twig', [
            'events' => $events,
        ]);
    }
    
   
    
} 
    

    


  



