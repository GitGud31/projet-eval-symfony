<?php

namespace App\Controller;

use App\Form\HomeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(Request $request): Response
    {
        $formValue = $this->createform(HomeType::class);
        $formValue->handleRequest($request);

        if ($formValue->isSubmitted() && $formValue->isValid()) {

            $date_start = $formValue->get('date_heure_depart')->getData();
            $date_end = $formValue->get('date_heure_fin')->getData();

            return $this->redirectToRoute('vehicules', [
                'date_heure_fin' => $date_start,
                'date_heure_fin' => $date_end
            ]);
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'form_value' => $formValue,
        ]);
    }
}
