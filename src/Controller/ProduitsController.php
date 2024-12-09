<?php

namespace App\Controller;

use App\Entity\Materiel;
use App\Form\ProduitsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProduitsController extends AbstractController
{
    #[Route('/produits', name: 'app_produits')]

    public function new(Request $request): Response
    {
        $materiel = new Materiel();
        $materiel->setDateAchat(new \DateTime('now'));
        $form = $this->createForm(ProduitsType::class, $materiel);


        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

        }
        
        return $this->render('produits/index.html.twig', [
            'controller_name' => 'ProduitsController',
            'formProduits' => $form
        ]);
    }

}
