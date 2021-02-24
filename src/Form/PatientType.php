<?php

namespace App\Form;

use App\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'required'   => true,
                    'empty_data' => 'Nom Patient',
                    ]
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'required'   => true,
                    'empty_data' => 'Nom Patient',
                ]
            ])
            ->add('cin', TextType::class, [
                // juste 7otha lbara mil att ok fhemtek bie
                'required'   => false,
                'empty_data' => 'CIN Patient',
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('tel', TextType::class, [
                'required'   => false,
                'empty_data' => 'Num777 ',
                'attr' => [
                    'class' => 'form-control',

                ]
            ])
            ->add('fixe', TextType::class, [
                'required'   => false,
                'attr' => [
                    'class' => 'form-control',
                    'empty_data' => 'Nom Patient',
                ]
            ])
            ->add('email', EmailType::class, [
                'required'   => false,
                'attr' => [
                    'class' => 'form-control',
                    'empty_data' => 'Nom Patient',
                ]
            ])
            ->add('ville', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'required'   => true,
                    'empty_data' => 'Nom Patient',
                ]
            ])
            ->add('pays', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'required'   => true,
                    'empty_data' => 'Nom Patient',
                ]
            ])
            ->add('region', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'required'   => true,
                    'empty_data' => 'Nom Patient',
                ]
            ])
            ->add('codePostal', TextType::class, [
                'required'   => false,
                'attr' => [
                    'class' => 'form-control',
                    'empty_data' => 'Nom Patient',
                ]
            ])
            ->add('cnss', TextType::class, [
                'required'   => false,
                'attr' => [
                    'class' => 'form-control',
                    'empty_data' => 'Nom Patient',
                ]
            ])
            ->add('cnrps', TextType::class, [
                'required'   => false,
                'attr' => [
                    'class' => 'form-control',
                    'empty_data' => 'Nom Patient',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
