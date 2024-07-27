<?php
namespace App\Controller;

use App\Entity\EventDetails;
use App\Entity\MeetingRequest;
use App\Entity\UserRegister;
use App\Form\RegisterType;
use App\Form\RequestMeetingType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function new(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher, ManagerRegistry $doctrine): Response
    {
        $user = new UserRegister();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);
        $requestMeet = new MeetingRequest();
        $form1 = $this->createForm(RequestMeetingType::class, $requestMeet);
        $form1->handleRequest($request);
        $events = $doctrine->getRepository(EventDetails::class)->findAll();

        

        if ($form->isSubmitted() && $form->isValid()) {
            $existingUser = $doctrine->getRepository(UserRegister::class)->findOneBy(['email' => $user->getEmail()]);

            if ($existingUser) {
                $this->addFlash('error', 'Email already exists.');
            } else {
                $user->setPassword(
                    $passwordHasher->hashPassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );

                $em->persist($user);
                $em->flush();

                return $this->render('home/home.html.twig', [
                    'events' => $events,
                    'form' => $form1->createView(),
                ]);
            }
        }

        return $this->render('register/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
