<?php

namespace EX\GrumpyBundle\Form;

use EX\GrumpyBundle\Entity\Evenement;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ProduitType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('categorie', ChoiceType::class, array('choices' => array('Goodies' => 'Goodies', 'Vetement' => 'Vetement', 'Alimentaire'=>'Alimentaire', 'Autre' => 'Autre')))
            ->add('prix', IntegerType::class)
            ->add('description', TextareaType::class)
        ;
    }

}