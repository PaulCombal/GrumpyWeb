<?php

namespace EX\GrumpyBundle\Controller;
use EX\GrumpyBundle\Entity\Groupe;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
}
