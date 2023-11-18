<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Form\AddVehiculeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionVoituresController extends AbstractController
{
    #[Route('/gestion/voitures', name: 'gestion_voitures')]
    public function gestion_voitures(Request                $request,
                                     EntityManagerInterface $entityManager): Response
    {
        $vehicule = new Vehicule();
        $vehicule->setDateEnregistrement(new \DateTime());

        $formValue = $this->createForm(AddVehiculeType::class, $vehicule);
        $formValue->handleRequest($request);

        if ($formValue->isSubmitted() && $formValue->isValid()) {
            $entityManager->persist($vehicule);
            $entityManager->flush();

            return $this->redirectToRoute('gestion_voitures');
        }

        return $this->render('gestion_voitures/index.html.twig', [
            'controller_name' => 'GestionVoituresController',
            'form_value' => $formValue,
        ]);
    }
}
