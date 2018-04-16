<?php

namespace EX\GrumpyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use EX\GrumpyBundle\Entity\Groupe;
use EX\GrumpyBundle\Form\Type\GroupeType;

/**
 * Groupe controller.
 *
 * @Route("/admin/groups")
 */
class GroupeController extends Controller
{
    /**
     * Lists all Groupe entities.
     *
     * @Route("/", name="admin_groups")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('EXGrumpyBundle:Groupe')->findAll();
        
        return array(
            'entities'  => $entities,
        );
    }

    /**
     * Finds and displays a Groupe entity.
     *
     * @Route("/{id}/show", name="admin_groups_show", requirements={"id"="\d+"})
     * @Method("GET")
     * @Template()
     */
    public function showAction(Groupe $groupe)
    {
        $deleteForm = $this->createDeleteForm($groupe->getId(), 'admin_groups_delete');

        return array(
            'groupe' => $groupe,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Groupe entity.
     *
     * @Route("/new", name="admin_groups_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $groupe = new Groupe(md5(rand()));
        $form = $this->createForm(GroupeType::class, $groupe);

        return array(
            'groupe' => $groupe,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Groupe entity.
     *
     * @Route("/create", name="admin_groups_create")
     * @Method("POST")
     * @Template("EXGrumpyBundle:Groupe:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $groupe = new Groupe(md5(rand()));
        $form = $this->createForm(GroupeType::class, $groupe);
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($groupe);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_groups_show', array('id' => $groupe->getId())));
        }

        return array(
            'groupe' => $groupe,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Groupe entity.
     *
     * @Route("/{id}/edit", name="admin_groups_edit", requirements={"id"="\d+"})
     * @Method("GET")
     * @Template()
     */
    public function editAction(Groupe $groupe)
    {
        $editForm = $this->createForm(GroupeType::class, $groupe, array(
            'action' => $this->generateUrl('admin_groups_update', array('id' => $groupe->getId())),
            'method' => 'PUT',
        ));
        $deleteForm = $this->createDeleteForm($groupe->getId(), 'admin_groups_delete');

        return array(
            'groupe' => $groupe,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Groupe entity.
     *
     * @Route("/{id}/update", name="admin_groups_update", requirements={"id"="\d+"})
     * @Method("PUT")
     * @Template("EXGrumpyBundle:Groupe:edit.html.twig")
     */
    public function updateAction(Groupe $groupe, Request $request)
    {
        $editForm = $this->createForm(GroupeType::class, $groupe, array(
            'action' => $this->generateUrl('admin_groups_update', array('id' => $groupe->getId())),
            'method' => 'PUT',
        ));
        if ($editForm->handleRequest($request)->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('admin_groups_edit', array('id' => $groupe->getId())));
        }
        $deleteForm = $this->createDeleteForm($groupe->getId(), 'admin_groups_delete');

        return array(
            'groupe' => $groupe,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Groupe entity.
     *
     * @Route("/{id}/delete", name="admin_groups_delete", requirements={"id"="\d+"})
     * @Method("DELETE")
     */
    public function deleteAction(Groupe $groupe, Request $request)
    {
        $form = $this->createDeleteForm($groupe->getId(), 'admin_groups_delete');
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($groupe);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_groups'));
    }

    /**
     * Create Delete form
     *
     * @param integer                       $id
     * @param string                        $route
     * @return \Symfony\Component\Form\Form
     */
    protected function createDeleteForm($id, $route)
    {
        return $this->createFormBuilder(null, array('attr' => array('id' => 'delete')))
            ->setAction($this->generateUrl($route, array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

}
