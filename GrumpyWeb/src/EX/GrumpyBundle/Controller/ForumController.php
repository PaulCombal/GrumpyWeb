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
use EX\GrumpyBundle\Form\EvenementType;
use Symfony\Component\Security\Http\Firewall\ContextListener;


class ForumController extends Controller
{
 public function indexAction()
  {
    $bite = "Je n'ai pas le pouvoir de confirmer les idees";
    if(TRUE ===$this->get('security.authorization_checker')->isGranted('ROLE_CONFIRM_IDEAS') )
      $bite = "Je peux modifier les idees";

    $listAdverts = array(
      array(
        'title'   => 'Grosse boite',
        'id'      => 1,
        'author'  => 'Alexandre',
        'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
        'date'    => new \Datetime()),
      array(
        'title'   => 'Manger des gauffres',
        'id'      => 2,
        'author'  => $bite,
        'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
        'date'    => new \Datetime()),
      array(
        'title'   => 'L\'art de la pose clope inopinée',
        'id'      => 3,
        'author'  => 'Nassim',
        'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
        'date'    => new \Datetime())
    );

    // Mais pour l'instant, on ne fait qu'appeler le template
    return $this->render("@EXGrumpy/Forum/index.html.twig", array(
      'listAdverts' => $listAdverts
    ));
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
      $evenement = new Evenement();
      $evenement->setStatut("idée");
      $evenement->setIdUtilisateur($user->getid());
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

}
