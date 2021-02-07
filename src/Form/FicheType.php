<?php

namespace App\Form;

use App\Entity\Fiche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FicheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('antecedentMaladie')
            ->add('abitudeVie')
            ->add('histoireMaladie')
            ->add('exploration')
            ->add('diagnostic')
            /*->add('createdAt')
            ->add('updatedAt')
            ->add('deletedAt')
            ->add('isDeleted')
            ->add('patient')
            ->add('medecin')*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Fiche::class,
        ]);
    }
}
