<?php

namespace App\Controller;

use App\Entity\EventDetails;
use App\Entity\MeetingRequest;
use App\Form\RequestMeetingType;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        $requestMeet = new MeetingRequest();
        $form = $this->createForm(RequestMeetingType::class, $requestMeet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($requestMeet);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        $events = $doctrine->getRepository(EventDetails::class)->findAll();

        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            'events' => $events,
            'form' => $form->createView(),
        ]);
    }
  

    #[Route('/requests', name: 'app_userdashBoard_requests')]
    public function fetchData(ManagerRegistry $doctrine): Response
    {
        $requests = $doctrine->getRepository(MeetingRequest::class)->findAll();
        return $this->render('MeetingRequests/MeetingRequests.html.twig', [
            'controller_name' => 'HomeController',
            'request' => $requests,
        ]);
    }
}
