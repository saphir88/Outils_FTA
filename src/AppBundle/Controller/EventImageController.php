<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EventImage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Eventimage controller.
 *
 * @Route("eventimage")
 */
class EventImageController extends Controller
{
    /**
     * Lists all eventImage entities.
     *
     * @Route("/", name="eventimage_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $eventImages = $em->getRepository('AppBundle:EventImage')->findAll();

        return $this->render('eventimage/index.html.twig', array(
            'eventImages' => $eventImages,
        ));
    }

    /**
     * Creates a new eventImage entity.
     *
     * @Route("/new", name="eventimage_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $eventImage = new Eventimage();
        $form = $this->createForm('AppBundle\Form\EventImageType', $eventImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($eventImage);
            $em->flush();

            return $this->redirectToRoute('eventimage_show', array('id' => $eventImage->getId()));
        }

        return $this->render('eventimage/new.html.twig', array(
            'eventImage' => $eventImage,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a eventImage entity.
     *
     * @Route("/{id}", name="eventimage_show")
     * @Method("GET")
     */
    public function showAction(EventImage $eventImage)
    {
        $deleteForm = $this->createDeleteForm($eventImage);

        return $this->render('eventimage/show.html.twig', array(
            'eventImage' => $eventImage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing eventImage entity.
     *
     * @Route("/{id}/edit", name="eventimage_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EventImage $eventImage)
    {
        $deleteForm = $this->createDeleteForm($eventImage);
        $editForm = $this->createForm('AppBundle\Form\EventImageType', $eventImage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('eventimage_edit', array('id' => $eventImage->getId()));
        }

        return $this->render('eventimage/edit.html.twig', array(
            'eventImage' => $eventImage,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a eventImage entity.
     *
     * @Route("/{id}", name="eventimage_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EventImage $eventImage)
    {
        $form = $this->createDeleteForm($eventImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($eventImage);
            $em->flush();
        }

        return $this->redirectToRoute('eventimage_index');
    }

    /**
     * Creates a form to delete a eventImage entity.
     *
     * @param EventImage $eventImage The eventImage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EventImage $eventImage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('eventimage_delete', array('id' => $eventImage->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
