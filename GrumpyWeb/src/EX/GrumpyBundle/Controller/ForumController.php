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

  public function menuAction($limit)
  {
    // On fixe en dur une liste ici, bien entendu par la suite
    // on la récupérera depuis la BDD !
    $listAdverts = array(
      array('id' => 2, 'title' => 'Recherche développeur Symfony'),
      array('id' => 5, 'title' => 'Mission de webmaster'),
      array('id' => 9, 'title' => 'Offre de stage webdesigner')
    );

    return $this->render("@EXGrumpy/Forum/menu.html.twig", array(
      // Tout l'intérêt est ici : le contrôleur passe
      // les variables nécessaires au template !
      'listAdverts' => $listAdverts
    ));
    }

    public function add_eventAction(Request $request)
    {
      $user = $this->getUser();
      if ($user == null) {
        die("Veuillez vous connecter.");
      }
      $evenement = new Evenement();
      $evenement->setStatut("idée");
      $evenement->setIdUtilisateur($user);
      $form = $this->createForm(EvenementType::class, $evenement);


      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evenement);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('ex_grumpy_add_event');
        }

        return $this->render(
            '@EXGrumpy/Forum/add_event.html.twig',
            array('form' => $form->createView())
        );
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

    public function add_commentaireAction(Request $request, $cat_comment, $event_id)
    {
      $user = $this->getUser();
      if ($user == null) {
        die("Veuillez vous connecter.");
      }
      $evenement = $this->getDoctrine()
        ->getRepository(Evenement::class)
        ->findBy
        (
          [ 'id' => $event_id ],
          null,
          1,
          0
        );

      $commentaire = new Commentaire();
      $commentaire->setIdEvenement(current($evenement));
      $commentaire->setIdUtilisateur($user);
      $commentaire->setTypeContenu($cat_comment);

      
      $form = $this->createForm(CommentaireType::class, $commentaire);


      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($commentaire);
        $entityManager->flush();

        // ... do any other work - like sending them an email, etc
        // maybe set a "flash" success message for the user

        return $this->redirectToRoute('ex_grumpy_add_comment', array('event_id' => $event_id, 'cat_comment' => $cat_comment));
      }

      switch ($cat_comment) {
        case 'like':
          return new Response("Vous avez mis un like");
          break;
        case 'dislike':
          return new Response("Vous avez mis un dislike");
          break;
        case 'image':
          return $this->render(
          '@EXGrumpy/Forum/add_commentaire_'.$cat_comment.'.html.twig', ['form' => $form->createView()]);
          break;
        case 'commentaire':
          return $this->render(
          '@EXGrumpy/Forum/add_commentaire_'.$cat_comment.'.html.twig', ['form' => $form->createView()]);
          break;
        default:
          die("Bvn in the matrix");
          break;
      }
    }

    public function view_ideeAction(Request $request) {
      $user = $this->getUser();
      if ($user == null) {
        return $this->redirectToRoute('fos_user_security_login');
      }

      $events = $this->getDoctrine()
        ->getRepository(Evenement::class)
        ->findBy
        (
          [ 'statut' => 'idée' ],
          null,
          10,
          0
        );

      $temp = [];
      foreach ($events as &$event) {
        $temp[] = 
        [
          "title" => $event->getNom(), 
          "price" => $event->getPrix(), 
          "start_date" => $event->getDateDebut(), 
          "repetition" => "Tous les " . $event->getRepetition() . " jours",
          "description" => $event->getDescription(),
          "statut" => $event->getStatut(),
          "chemin_image" => "http://via.placeholder.com/350x150"
        ];
      }

      unset($events);

      return $this->render('@EXGrumpy/Forum/view_idee.html.twig', ['events' => $temp]);
    }

    public function view_eventsAction(Request $request) {
      $user = $this->getUser();
      if ($user == null) {
        return $this->redirectToRoute('fos_user_security_login');
      }

      $events = $this->getDoctrine()
        ->getRepository(Evenement::class)
        ->findBy
        (
          [ 'statut' => 'officiel' ],
          null,
          10,
          0
        );

      $temp = [];
      foreach ($events as &$event) {
        $temp[] = 
        [
          "title" => $event->getNom(), 
          "price" => $event->getPrix(), 
          "start_date" => $event->getDateDebut(), 
          "repetition" => "Tous les " . $event->getRepetition() . " jours",
          "description" => $event->getDescription(),
          "statut" => $event->getStatut(),
          "chemin_image" => "http://via.placeholder.com/350x150"
        ];
      }

      unset($events);

      return $this->render('@EXGrumpy/Forum/view_events.html.twig', ['events' => $temp]);
    }


    public function viewAction($event_id) {
      $user = $this->getUser();
      if ($user == null) {
        return $this->redirectToRoute('fos_user_security_login');
      }

      $isSubscribedAlready = $this->getDoctrine()
        ->getRepository(Inscription::class)
        ->findBy
        (
          [ 'idEvenement' => $event_id, 'idUtilisateur' => $user->getId() ],
          null,
          1,
          0
        );

      $event = $this->getDoctrine()
        ->getRepository(Evenement::class)
        ->find($event_id);

      $commentaires = $this->getDoctrine()
        ->getRepository(Commentaire::class)
        ->findBy
        (
          [ 'idEvenement' => $event_id],
          null,
          50,
          0
        );

        $temp = [];
        
      foreach ($commentaires as &$commentaire) {

        $temp[] = 
        [
          "contenu" => $commentaire->getContenu(),
          "poster_name" => $commentaire->getIdUtilisateur(),
          "type" => $commentaire->getTypeContenu()
        ];
      }

      $event = 
      [
        "title" => $event->getNom(), 
        "price" => $event->getPrix(), 
        "start_date" => $event->getDateDebut(), 
        "repetition" => "Tous les " . $event->getRepetition() . " jours",
        "description" => $event->getDescription(),
        "statut" => $event->getStatut(),
        "chemin_image" => $event->getCheminImage(),
        "event_id" => $event_id,
        "is_subscribed" => sizeof($isSubscribedAlready) > 0,
        "commentaires" => $temp
      ];


      return $this->render('@EXGrumpy/Forum/view_event.html.twig', $event);

    }

    public function subscribe_eventAction($event_id) {
      $user = $this->getUser();
      if ($user == null) {
        return $this->redirectToRoute('fos_user_security_login');
      }

      $isSubscribedAlready = $this->getDoctrine()
        ->getRepository(Inscription::class)
        ->findBy
        (
          [ 'idEvenement' => $event_id, 'idUtilisateur' => $user->getId() ],
          null,
          1,
          0
        );

      if (sizeof($isSubscribedAlready) > 0) {
        return $this->redirectToRoute('ex_grumpy_view_event', ['event_id' => $event_id]);
      }

      $event = $this->getDoctrine()
        ->getRepository(Evenement::class)
        ->find($event_id);

      $inscription = new Inscription();
      $inscription->setIdEvenement($event);
      $inscription->setIdUtilisateur($user);

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($inscription);
      $entityManager->flush();


      return $this->redirectToRoute('ex_grumpy_view_event', ['event_id' => $event_id]);

    }

}
