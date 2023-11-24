<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Repository\VehiculeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    #[Route('/commande/add/{vehicule_id},from={date_start},to={date_end}', name: 'add_commande')]
    public function commande(int                $vehicule_id,
                             string             $date_start,
                             string             $date_end,
                             VehiculeRepository $vehiculeRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');

        $vehicule = $vehiculeRepository->find($vehicule_id);

        $from = \DateTime::createFromFormat('U', $date_start);
        $to = \DateTime::createFromFormat('U', $date_end);
        $interval = $to->diff($from);

        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
            'vehicule' => $vehicule,
            'interval' => $interval,
            'from' => $from,
            'to' => $to,
        ]);
    }
}
