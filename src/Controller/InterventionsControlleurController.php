<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InterventionsControlleurController extends AbstractController
{
    #[Route('/interventions/controlleur', name: 'app_interventions_controlleur')]
    public function index(): Response
    {
        return $this->render('interventions_controlleur/index.html.twig', [
            'controller_name' => 'InterventionsControlleurController',
        ]);
    }
}
