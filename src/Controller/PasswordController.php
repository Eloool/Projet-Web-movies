<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordController extends AbstractController
{
    #[Route('/create_password', name: 'app_create_password')]
    public function createPassword(): Response
    {
        return $this->render('greeting/hello.html.twig');
    }

    
    #[Route('/create_user', name: 'app_create_user' , methods: ['POST'])]
    public function createUser(Request $request, UserRepository $userRepository, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $name = $request->request->get('name');
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setPassword($passwordEncoder->encodePassword($user, $password));

        $userRepository->save($user);

        return new Response('User created successfully');
    }
}