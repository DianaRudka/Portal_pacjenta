<?php

namespace PortalBundle\Controller;

use PortalBundle\Entity\Medical;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Medical controller.
 *
 * @Route("medical")
 */
class MedicalController extends Controller
{
    /**
     * Lists all medical entities.
     *
     * @Route("/", name="medical_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $medicals = $em->getRepository('PortalBundle:Medical')->findAll();

        return $this->render('medical/index.html.twig', array(
            'medicals' => $medicals,
        ));
    }

    /**
     * Creates a new medical entity.
     *
     * @Route("/new", name="medical_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $medical = new Medical();
        $form = $this->createForm('PortalBundle\Form\MedicalType', $medical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($medical);
            $em->flush($medical);

            return $this->redirectToRoute('medical_show', array('id' => $medical->getId()));
        }

        return $this->render('medical/new.html.twig', array(
            'medical' => $medical,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a medical entity.
     *
     * @Route("/{id}", name="medical_show")
     * @Method("GET")
     */
    public function showAction(Medical $medical)
    {
        $deleteForm = $this->createDeleteForm($medical);

        return $this->render('medical/show.html.twig', array(
            'medical' => $medical,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing medical entity.
     *
     * @Route("/{id}/edit", name="medical_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Medical $medical)
    {
        $deleteForm = $this->createDeleteForm($medical);
        $editForm = $this->createForm('PortalBundle\Form\MedicalType', $medical);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('medical_edit', array('id' => $medical->getId()));
        }

        return $this->render('medical/edit.html.twig', array(
            'medical' => $medical,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a medical entity.
     *
     * @Route("/{id}", name="medical_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Medical $medical)
    {
        $form = $this->createDeleteForm($medical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($medical);
            $em->flush($medical);
        }

        return $this->redirectToRoute('medical_index');
    }

    /**
     * Creates a form to delete a medical entity.
     *
     * @param Medical $medical The medical entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Medical $medical)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('medical_delete', array('id' => $medical->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
