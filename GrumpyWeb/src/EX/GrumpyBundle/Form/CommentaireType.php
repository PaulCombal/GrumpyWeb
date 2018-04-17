<?php

namespace EX\GrumpyBundle\Form;

use EX\GrumpyBundle\Entity\Commentaire;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Http\Firewall\ContextListener;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CommentaireType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$builder
            ->add('contenu', TextType::class);
    }

}