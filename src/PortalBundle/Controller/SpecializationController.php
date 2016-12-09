<?php

namespace PortalBundle\Controller;

use PortalBundle\Entity\Specialization;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Specialization controller.
 *
 * @Route("spec")
 */
class SpecializationController extends Controller
{
    /**
     * Lists all specialization entities.
     *
     * @Route("/", name="spec_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $specializations = $em->getRepository('PortalBundle:Specialization')->findAll();

        return $this->render('specialization/index.html.twig', array(
            'specializations' => $specializations,
        ));
    }

    /**
     * Creates a new specialization entity.
     *
     * @Route("/new", name="spec_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $specialization = new Specialization();
        $form = $this->createForm('PortalBundle\Form\SpecializationType', $specialization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($specialization);
            $em->flush($specialization);

            return $this->redirectToRoute('spec_index', array('id' => $specialization->getId()));
        }

        return $this->render('specialization/new.html.twig', array(
            'specialization' => $specialization,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a specialization entity.
     *
     * @Route("/{id}", name="spec_show")
     * @Method("GET")
     */
    public function showAction(Specialization $specialization)
    {
        $deleteForm = $this->createDeleteForm($specialization);

        return $this->render('specialization/show.html.twig', array(
            'specialization' => $specialization,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing specialization entity.
     *
     * @Route("/{id}/edit", name="spec_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Specialization $specialization)
    {
        $deleteForm = $this->createDeleteForm($specialization);
        $editForm = $this->createForm('PortalBundle\Form\SpecializationType', $specialization);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('spec_edit', array('id' => $specialization->getId()));
        }

        return $this->render('specialization/edit.html.twig', array(
            'specialization' => $specialization,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a specialization entity.
     *
     * @Route("/{id}", name="spec_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Specialization $specialization)
    {
        $form = $this->createDeleteForm($specialization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($specialization);
            $em->flush($specialization);
        }

        return $this->redirectToRoute('spec_index');
    }

    /**
     * Creates a form to delete a specialization entity.
     *
     * @param Specialization $specialization The specialization entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Specialization $specialization)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('spec_delete', array('id' => $specialization->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
