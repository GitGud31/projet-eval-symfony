<?php

namespace App\Controller;

use App\Repository\MembreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionMembresController extends AbstractController
{
    #[Route('/gestion/membres', name: 'gestion_membres')]
    public function index(MembreRepository $membreRepository): Response
    {

        $membres = $membreRepository->findAll();

        return $this->render('gestion_membres/index.html.twig', [
            'controller_name' => 'GestionMembresController',
            'membres' => $membres,
        ]);
    }
}
