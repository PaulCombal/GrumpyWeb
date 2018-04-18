<?php

namespace EX\GrumpyBundle\Controller;

use EX\GrumpyBundle\Entity\Groupe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use EX\GrumpyBundle\Entity\Evenement;
use EX\GrumpyBundle\Entity\Produit;
use EX\GrumpyBundle\Entity\Commentaire;
use EX\GrumpyBundle\Entity\Commande;
use EX\GrumpyBundle\Form\CommentaireType;
use EX\GrumpyBundle\Entity\Inscription;
use EX\GrumpyBundle\Form\EvenementType;
use EX\GrumpyBundle\Form\ProduitType;
use Symfony\Component\Security\Http\Firewall\ContextListener;
use Symfony\Component\HttpFoundation\Response;


class ForumController extends Controller
{
	
	public function indexAction()
	{
		$test = "Je n'ai pas le pouvoir de confirmer les idees";
		if(TRUE ===$this->get('security.authorization_checker')->isGranted('ROLE_CONFIRM_IDEAS') )
			$test = "Je peux modifier les idees";

		return $this->render("@EXGrumpy/Forum/index.html.twig");
	}
}