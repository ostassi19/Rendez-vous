<?php

namespace App\Form;

use App\Entity\RendezVous;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class RendezVousType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateTimeType::class, [
/*
                'widget' => 'single_text',
                'html5' => false,
                'attr' => [
                    'class' => 'combinedPickerInput',
                    'placeholder' => date('d/m/y H:i'),
                ],
*/
                'placeholder' => [
                    'year' => 'Anne', 'month' => 'Mois', 'day' => 'Jour',
                    'hour' => 'Heur', 'minute' => 'Minute', 'second' => 'Second',
                ]

            ])
            //->add('createdAt')
            //->add('updatedAt')
            //->add('deletedAt')
            //->add('isDeleted')
            //->add('fiche')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RendezVous::class,
        ]);
    }
}
