<?php

namespace AppBundle\Controller;

use AppBundle\Entity\StartUps;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Startup controller.
 *
 * @Route("startups")
 */
class StartUpsController extends Controller
{
    /**
     * Lists all startUp entities.
     *
     * @Route("/", name="startups_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $startUps = $em->getRepository('AppBundle:StartUps')->findAll();

        return $this->render('startups/index.html.twig', array(
            'startUps' => $startUps,
        ));
    }

    /**
     * Creates a new startUp entity.
     *
     * @Route("/new", name="startups_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $startUp = new Startup();
        $form = $this->createForm('AppBundle\Form\StartUpsType', $startUp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($startUp);
            $em->flush();

            return $this->redirectToRoute('startups_show', array('id' => $startUp->getId()));
        }

        return $this->render('startups/new.html.twig', array(
            'startUp' => $startUp,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a startUp entity.
     *
     * @Route("/{id}", name="startups_show")
     * @Method("GET")
     */
    public function showAction(StartUps $startUp)
    {
        $deleteForm = $this->createDeleteForm($startUp);

        return $this->render('startups/show.html.twig', array(
            'startUp' => $startUp,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing startUp entity.
     *
     * @Route("/{id}/edit", name="startups_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, StartUps $startUp)
    {
        $deleteForm = $this->createDeleteForm($startUp);
        $editForm = $this->createForm('AppBundle\Form\StartUpsType', $startUp);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('startups_edit', array('id' => $startUp->getId()));
        }

        return $this->render('startups/edit.html.twig', array(
            'startUp' => $startUp,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a startUp entity.
     *
     * @Route("/{id}", name="startups_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, StartUps $startUp)
    {
        $form = $this->createDeleteForm($startUp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($startUp);
            $em->flush();
        }

        return $this->redirectToRoute('startups_index');
    }

    /**
     * Creates a form to delete a startUp entity.
     *
     * @param StartUps $startUp The startUp entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(StartUps $startUp)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('startups_delete', array('id' => $startUp->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
