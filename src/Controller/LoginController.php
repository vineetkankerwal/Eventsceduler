<?php

namespace App\Controller;

use App\Entity\EventDetails;
Use App\Entity\UserRegister;
use App\Form\LoginType;
Use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function new(Request $request, EntityManagerInterface $em,UserPasswordHasherInterface $passwordHasher): Response
    {
    $user = new UserRegister();
    $form = $this->createForm(LoginType::class,$user);

    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()){
        $data=$form->getData();
        $email=$data->getEmail();
        $password=$form->get('plainPassword')->getData();
     
 

        $userRepository = $em->getRepository(UserRegister::class);
        $user = $userRepository->findOneBy(['email' => $email]);
        
        if(!$user){
            return $this->render('login/login.html.twig',['form' => $form->createView(),'error' => ' incorrect username or password']);
        }
        if($passwordHasher->isPasswordValid($user,$password)){
            return $this->redirectToRoute('app_user_dashboard');

        }else{
            return $this->render('login/login.html.twig', [ 'form' => $form->createView(), 'error'=> 'incorrect username or password']);
           
        }
    }


    return $this->render('login/login.html.twig', [ 'form' => $form->createView(), 'error'=> '']);
}

#[Route('/userdashboard',name:"app_user_dashboard")]
public function userDashboard(ManagerRegistry $doctrine):Response
{
    $events = $doctrine->getRepository(EventDetails::class)->findAll();
    return $this->render('Userdashboard/UserDashboard.html.twig',[
        'events' => $events,
        
    ]);



}

}
