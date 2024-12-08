<?php

namespace App\Controller;

use App\Entity\Materiel;
use App\Form\ProduitsType;
use App\Repository\MaterielRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProduitsController extends AbstractController
{
    #[Route('/produits', name: 'app_produits')]

    public function new(Request $request, EntityManagerInterface $entityManager, MaterielRepository $materielRepository ): Response
    {
        $materiel = new Materiel();
        $materiel->setDateAchat(new \DateTime('now'));
        $form = $this->createForm(ProduitsType::class, $materiel);


        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $matos = $form->getData();
            $entityManager->persist($matos);
            $entityManager->flush();

            return $this->redirectToRoute('app_produits');
        }

        $listMatos = $materielRepository->findAll();
        
        return $this->render('produits/index.html.twig', [
            'controller_name' => 'ProduitsController',
            'listMatos' => $listMatos,
            'formProduits' => $form
        ]);
    }

}
