<?php

namespace App\Form;

use App\Entity\Intervention;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InterventionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateInter', null, [
                'widget' => 'single_text',
            ])
            ->add('description')
            ->add('duree', null, [
                'widget' => 'single_text',
            ])
            ->add('statut', ChoiceType::class,
            [ 'choices' =>[
                            'Demande reçu' => "Demande reçu",
                            'Traitement en cours' => "Traitement en cours",
                            'Demande finalisé' => "Demande finalisé"
                        ]

            ])
            ->add('prix')
            ->add('Valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Intervention::class,
        ]);
    }
}
