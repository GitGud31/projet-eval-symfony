<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Form\EditProfileType;
use App\Repository\CommandeRepository;
use App\Repository\MembreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

        // flash()->addSuccess("Membre" . ${$membre->getEmail()} . " à été supprimé(e).");

        return $this->redirectToRoute('gestion_membres');
    }

    #[Route('/member/edit/{id}', name: 'edit_membre')]
    public function edit(Membre                 $membre,
                         EntityManagerInterface $entityManager,
                         Request                $request)
    {
        $formValue = $this->createForm(EditProfileType::class, $membre);
        $formValue->handleRequest($request);
        if ($formValue->isSubmitted() && $formValue->isValid()) {
            $entityManager->flush();

            flash()->addSuccess('Your changes were saved!');

            return $this->redirectToRoute('gestion_membres');
        }

        return $this->render(
            'gestion_membres/edit_membre.html.twig', [
                'controller_name' => 'GestionMembresController',
                'form_value' => $formValue,
                'membre' => $membre,
            ]
        );
    }
}
