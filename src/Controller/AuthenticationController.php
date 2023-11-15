<?php

namespace App\Controller;

use App\Form\AuthenticationType;
use App\Form\SignupType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
    public function signup(): Response
    {
        $formValue = $this->createForm(SignupType::class);

        return $this->render('sign_up/index.html.twig', [
            'controller_name' => 'AuthenticationController',
            'form_value' => $formValue,
        ]);
    }
}
