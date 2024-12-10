<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ParametresType;
use App\Repository\MaterielRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ParametresController extends AbstractController
{
    #[Route('/parametres', name: 'app_parametres')]



    public function new(Request $request, EntityManagerInterface $entityManager, MaterielRepository $materielRepository, LoggerInterface $loggerInterface): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');

        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $this->getUser()->getUserIdentifier()]);


        $form = $this->createForm(ParametresType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

            $entityManager->flush();
        }

        return $this->render('parametres/index.html.twig',
        [
        'controller_name' => 'ParametresController',
        'formParametres' => $form
        ]);
    }
}
