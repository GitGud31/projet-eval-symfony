<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Repository\CommandeRepository;
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

    #[Route('/member/delete/{id}', name: 'member_delete')]
    public function delete(Membre             $membre,
                           MembreRepository   $membreRepository,
                           CommandeRepository $commandeRepository): Response
    {
        $commandeRepository->removeByMemberId($membre->getId());
        $membreRepository->remove($membre);
        return $this->redirectToRoute('gestion_membres');
    }
}
