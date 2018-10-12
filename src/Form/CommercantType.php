<?php

namespace App\Form;

use App\Entity\Commercant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CommercantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('siret', TextType::class, array('label' => 'Siret'))
            ->add('logo', FileType::class, array('label' => 'Logo de l\'entreprise', 'required' => false))
            ->add('denomination', TextType::class, array('label' => 'Denomination'))
            ->add('adresse_siege', TextType::class, array('label' => 'Adresse du siège'))
            ->add('save', SubmitType::class, array('label' => 'Enregistrer l\'entreprise'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Commercant::class
        ));
    }
}