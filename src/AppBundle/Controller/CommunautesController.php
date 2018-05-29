<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Communautes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Communaute controller.
 *
 * @Route("communautes")
 */
class CommunautesController extends Controller
{
    /**
     * Lists all communaute entities.
     *
     * @Route("/", name="communautes_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $communautes = $em->getRepository('AppBundle:Communautes')->findAll();

        return $this->render('communautes/index.html.twig', array(
            'communautes' => $communautes,
        ));
    }

    /**
     * Creates a new communaute entity.
     *
     * @Route("/new", name="communautes_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $communaute = new Communautes();
        $form = $this->createForm('AppBundle\Form\CommunautesType', $communaute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($communaute);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('communautes/new.html.twig', array(
            'communaute' => $communaute,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a communaute entity.
     *
     * @Route("/{id}", name="communautes_show")
     * @Method("GET")
     */
    public function showAction(Communautes $communaute)
    {
        $deleteForm = $this->createDeleteForm($communaute);

        return $this->render('communautes/show.html.twig', array(
            'communaute' => $communaute,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing communaute entity.
     *
     * @Route("/{id}/edit", name="communautes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Communautes $communaute)
    {
        $deleteForm = $this->createDeleteForm($communaute);
        $editForm = $this->createForm('AppBundle\Form\CommunautesType', $communaute);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('communautes_edit', array('id' => $communaute->getId()));
        }

        return $this->render('communautes/edit.html.twig', array(
            'communaute' => $communaute,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a communaute entity.
     *
     * @Route("/{id}", name="communautes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Communautes $communaute)
    {
        $form = $this->createDeleteForm($communaute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($communaute);
            $em->flush();
        }

        return $this->redirectToRoute('communautes_index');
    }

    /**
     * Creates a form to delete a communaute entity.
     *
     * @param Communautes $communaute The communaute entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Communautes $communaute)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('communautes_delete', array('id' => $communaute->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
