<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Form\AuthenticationType;
use App\Form\SignupType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AuthenticationController extends AbstractController
{
    #[Route('/connexion', name: 'connexion')]
    public function connexion(): Response
    {
        $formValue = $this->createform(AuthenticationType::class);

        # dd($formValue);

        return $this->render('authentication/index.html.twig', [
            'controller_name' => 'AuthenticationController',
            'form_value' => $formValue,
        ]);
    }

    #[Route('/signup', name: 'signup')]
    public function signup(Request                $request, UserPasswordHasherInterface $passwordHasher,
                           EntityManagerInterface $entityManager): Response
    {
        # A new membre is automatically registered with DateTime Now.
        $membre = new Membre();
        $membre->setDateEnregistrement(new \DateTime());

        $formValue = $this->createForm(SignupType::class, $membre);
        $formValue->handleRequest($request);

        if ($formValue->isSubmitted() && $formValue->isValid()) {
            $membre->setMdp($passwordHasher->hashPassword($membre, $membre->getMdp()));

            $entityManager->persist($membre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home', [
            'controller_name' => 'HomeController',
        ]);
    }
}
