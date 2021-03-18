<?php

namespace App\Form;

use App\Entity\DemandeurEmploi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeurEmploiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adresse')
            ->add('email')
            ->add('telephone')
            ->add('nom')
            ->add('prenom')
            ->add('age')
            ->add('specialite')
            ->add('expProfessionnel')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DemandeurEmploi::class,
        ]);
    }
}
