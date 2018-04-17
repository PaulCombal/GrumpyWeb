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

		// Mais pour l'instant, on ne fait qu'appeler le template
		return $this->render("@EXGrumpy/Forum/index.html.twig");
	}


	public function add_productAction(Request $request)
	{

		$produit = new Produit();
		$form = $this->createForm(ProduitType::class, $produit);


		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

					$entityManager = $this->getDoctrine()->getManager();
					$entityManager->persist($produit);
					$entityManager->flush();

					// ... do any other work - like sending them an email, etc
					// maybe set a "flash" success message for the user

					return $this->redirectToRoute('ex_grumpy_add_product');
			}

			return $this->render(
					'@EXGrumpy/Forum/add_product.html.twig',
					array('form' => $form->createView())
			);
	}

	public function add_commandeAction(Request $request)
	{

		$commande = new Commande();
		$form = $this->createForm(CommandeType::class, $commande);


		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

					$entityManager = $this->getDoctrine()->getManager();
					$entityManager->persist($commande);
					$entityManager->flush();

					// ... do any other work - like sending them an email, etc
					// maybe set a "flash" success message for the user

					return $this->redirectToRoute('ex_grumpy_add_commande');
			}

			return $this->render(
					'@EXGrumpy/Forum/add_commande.html.twig',
					array('form' => $form->createView())
			);
	}


	

	public function view_productsAction(Request $request) {
		$user = $this->getUser();
		if ($user == null) {
			return $this->redirectToRoute('fos_user_security_login');
		}

		$products = $this->getDoctrine()
			->getRepository(Produit::class)
			->findAll();

		$temp = [];
		foreach ($products as &$product) {
			$temp[] = 
			[
				"name" => $product->getNom(),
				"price" => $product->getPrix() . '€',
				"description" => $product->getDescription(),
				"category" => $product->getCategorie(),
				"chemin_image" => "http://via.placeholder.com/350x150"
			];
		}

		unset($products);

		return $this->render('@EXGrumpy/Forum/view_products.html.twig', ['products' => $temp]);
	}

	public function view_productAction($product_id) {
		$user = $this->getUser();
		if ($user == null) {
			return $this->redirectToRoute('fos_user_security_login');
		}

		$product = $this->getDoctrine()
			->getRepository(Produit::class)
			->find($product_id);

		$product = 
		[
			"name" => $product->getNom(),
			"price" => $product->getPrix() . '€',
			"description" => $product->getDescription(),
			"category" => $product->getCategorie(),
			"chemin_image" => "http://via.placeholder.com/350x150"
		];

		return $this->render('@EXGrumpy/Forum/view_product.html.twig', $product);
	}
}