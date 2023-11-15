<?php

namespace App\Controller;

use App\Form\AuthenticationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthenticationController extends AbstractController
{
    #[Route('/connexion', name: 'connexion')]
    public function authentication(): Response
    {
        $formValue = $this->createform(AuthenticationType::class);

        # dd($formValue);

        return $this->render('authentication/index.html.twig', [
            'controller_name' => 'AuthenticationController',
            'form_value' => $formValue,
        ]);
    }
}
