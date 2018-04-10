<?php

namespace EX\GrumpyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        # return $this->render('EXGrumpyBundle:Default:index.html.twig');
        return $this->render("@EXGrumpy/Default/index.html.twig");
    }
}
