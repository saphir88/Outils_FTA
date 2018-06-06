<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Communaute;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Communaute controller.
 *
 * @Route("communaute")
 */
class CommunauteController extends Controller
{
    /**
     * Lists all communaute entities.
     *
     * @Route("/", name="communaute_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $communautes = $em->getRepository('AppBundle:Communaute')->findAllValidTrue();

        return $this->render('communaute/index.html.twig', array(
            'communautes' => $communautes,
        ));
    }

    /**
     * Creates a new communaute entity.
     *
     * @Route("/new", name="communaute_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $communaute = new Communaute();
        $form = $this->createForm('AppBundle\Form\CommunauteType', $communaute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($communaute);
            $em->flush();

            return $this->redirectToRoute('communaute_show', array('id' => $communaute->getId()));
        }

        return $this->render('communaute/new.html.twig', array(
            'communaute' => $communaute,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a communaute entity.
     *
     * @Route("/{id}", name="communaute_show")
     * @Method("GET")
     */
    public function showAction(Communaute $communaute)
    {
        $deleteForm = $this->createDeleteForm($communaute);

        return $this->render('communaute/show.html.twig', array(
            'communaute' => $communaute,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing communaute entity.
     *
     * @Route("/{id}/edit", name="communaute_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Communaute $communaute)
    {
        $deleteForm = $this->createDeleteForm($communaute);
        $editForm = $this->createForm('AppBundle\Form\CommunauteType', $communaute);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('communaute_edit', array('id' => $communaute->getId()));
        }

        return $this->render('communaute/edit.html.twig', array(
            'communaute' => $communaute,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a communaute entity.
     *
     * @Route("/{id}", name="communaute_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Communaute $communaute)
    {
        $form = $this->createDeleteForm($communaute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($communaute);
            $em->flush();
        }

        return $this->redirectToRoute('communaute_index');
    }

    /**
     * Creates a form to delete a communaute entity.
     *
     * @param Communaute $communaute The communaute entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Communaute $communaute)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('communaute_delete', array('id' => $communaute->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
