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
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');


        $materiel = new Materiel();
        $materiel->setDateAchat(new \DateTime('now'));
        $materiel->setIdClient($this->getUser()->getId());

        $form = $this->createForm(ProduitsType::class, $materiel);


        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $matos = $form->getData();
            $entityManager->persist($matos);
            $entityManager->flush();

            return $this->redirectToRoute('app_produits');
        }



        if($this->getUser()->getRoles()[0] == "technicien")
        {
            $listMatos = $materielRepository->findAll();
        }else
        {
            $listMatos = $materielRepository->findBy(array('idClient' => $this->getUser()->getId()));
        }
        


        return $this->render('produits/index.html.twig', 
        [
            'controller_name' => 'ProduitsController',
            'listMatos' => $listMatos,
            'formProduits' => $form,
            'role' => $this->getUser()->getRoles()[0]
        ]);
    }

}
