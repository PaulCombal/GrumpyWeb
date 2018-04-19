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
use EX\GrumpyBundle\Entity\Utilisateur;
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
		return $this->render("@EXGrumpy/Forum/index.html.twig");
	}

	public function view_legalAction() {
		return $this->render("@EXGrumpy/Forum/legal.html.twig");
	}

	public function test_apiAction() {
		return $this->render("@EXGrumpy/Forum/test_shop_api_ajax.html");
	}

	public function get_usersAction($event_id = '') {
		function array2csv(array &$array)
		{
		   if (count($array) == 0) {
		     return null;
		   }
		   ob_start();
		   $df = fopen("php://output", 'w');
		   fputcsv($df, array_keys(reset($array)));
		   foreach ($array as $row) {
		      fputcsv($df, $row);
		   }
		   fclose($df);
		   return ob_get_clean();
		}

		$user = $this->getUser();
		if ($user == null) {
			return $this->redirectToRoute('fos_user_security_login');
		}

		if (!$user->hasGroup('Membre BDE')) {
			return $this->redirectToRoute('fos_user_security_login');
		}

		$users = [];

		if (!empty($event_id)) {
			$subs = $this->getDoctrine()
				->getRepository(Inscription::class)
				->findBy(
					['idEvenement' => $event_id],
					null,
					5000,
					0
				);

			foreach ($subs as &$sub) {
				$users[] = $sub->getIdUtilisateur();
			}
		}
		else {
			// All users
			$users = $this->getDoctrine()
				->getRepository(Utilisateur::class)
				->findAll();
		}

		$temp = [];
		foreach ($users as &$user) {
			$temp[] = 
			[
				"prenom" => $user->getPrenom(),
				"nom" => $user->getNom(),
				"email" => $user->getEmail(),
				"pseudo" => $user->getId()
			];
		}

		if (sizeof($users) == 0) {
			return new Response("Aucun utilisateur n'est inscrit :(");
		}

		header("Content-Type: text/plain");
		header("Content-disposition: attachment; filename=users_bde.csv");
		return new Response(array2csv($temp));
	}

}