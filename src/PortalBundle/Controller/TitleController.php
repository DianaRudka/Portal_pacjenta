<?php

namespace PortalBundle\Controller;

use PortalBundle\Entity\Title;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Title controller.
 *
 * @Route("title")
 */
class TitleController extends Controller
{
    /**
     * Lists all title entities.
     *
     * @Route("/", name="title_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $titles = $em->getRepository('PortalBundle:Title')->findAll();

        return $this->render('title/index.html.twig', array(
            'titles' => $titles,
        ));
    }

    /**
     * Creates a new title entity.
     *
     * @Route("/new", name="title_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $title = new Title();
        $form = $this->createForm('PortalBundle\Form\TitleType', $title);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($title);
            $em->flush($title);

            return $this->redirectToRoute('title_show', array('id' => $title->getId()));
        }

        return $this->render('title/new.html.twig', array(
            'title' => $title,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a title entity.
     *
     * @Route("/{id}", name="title_show")
     * @Method("GET")
     */
    public function showAction(Title $title)
    {
        $deleteForm = $this->createDeleteForm($title);

        return $this->render('title/show.html.twig', array(
            'title' => $title,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing title entity.
     *
     * @Route("/{id}/edit", name="title_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Title $title)
    {
        $deleteForm = $this->createDeleteForm($title);
        $editForm = $this->createForm('PortalBundle\Form\TitleType', $title);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('title_edit', array('id' => $title->getId()));
        }

        return $this->render('title/edit.html.twig', array(
            'title' => $title,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a title entity.
     *
     * @Route("/{id}", name="title_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Title $title)
    {
        $form = $this->createDeleteForm($title);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($title);
            $em->flush($title);
        }

        return $this->redirectToRoute('title_index');
    }

    /**
     * Creates a form to delete a title entity.
     *
     * @param Title $title The title entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Title $title)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('title_delete', array('id' => $title->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
