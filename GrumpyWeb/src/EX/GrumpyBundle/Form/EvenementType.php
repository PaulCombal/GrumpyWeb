<?php

namespace EX\GrumpyBundle\Form;

use EX\GrumpyBundle\Entity\Evenement;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class EvenementType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('dateDebut', DatetimeType::class)
            ->add('prix', IntegerType::class)
            ->add('repetition', IntegerType::class)
            ->add('description', TextareaType::class)
        	->add('cheminImage', TextType::class)
        ;
    }

}