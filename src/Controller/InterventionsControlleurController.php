<?php

namespace App\Controller;

use App\Entity\Intervention;
use App\Form\InterventionsType;
use App\Repository\InterventionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InterventionsControlleurController extends AbstractController
{
    #[Route('/interventions/controlleur', name: 'app_interventions_controlleur')]
    public function new(Request $request, EntityManagerInterface $entityManager, InterventionRepository $interventionRepository): Response
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');

        
        $intervention = new Intervention();
        
        $form = $this->createForm(InterventionsType::class, $intervention);


        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $intervention = $form->getData();
            $entityManager->persist($intervention);
            $entityManager->flush();

            return $this->redirectToRoute(('app_interventions_controlleur'));
        }

        $listeInterventions = $interventionRepository->findAll();

        return $this->render( 'interventions_controlleur/index.html.twig',
        [
            'controller_name' => 'InterventionsControlleurController',
            'listeInterventions' => $listeInterventions,
            'formIntervention' => $form
        ]);
    }
}
