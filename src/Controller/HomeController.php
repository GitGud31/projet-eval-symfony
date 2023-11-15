<?php

namespace App\Controller;

use App\Form\HomeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $formValue = $this->createform(HomeType::class);

        # dd($formValue);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'form_value' => $formValue,
        ]);
    }
}
