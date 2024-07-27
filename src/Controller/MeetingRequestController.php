<?php
namespace App\Controller;
use App\Entity\MeetingRequest;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MeetingRequestController extends AbstractController
{
   #[Route('/myrequests', name: 'requestMeeting')]
   function index(ManagerRegistry $doctrine):Response{
   
    $requestMeetRecord = $doctrine->getRepository(MeetingRequest::class)->findAll();

    return $this->render('MeetingRequests/MeetingRequests.html.twig', [
        'requests' => $requestMeetRecord,
    
    ]);
   }
}
