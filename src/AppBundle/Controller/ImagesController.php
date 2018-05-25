<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Images;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Image controller.
 *
 * @Route("images")
 */
class ImagesController extends Controller
{
    /**
     * Lists all image entities.
     *
     * @Route("/", name="images_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $images = $em->getRepository('AppBundle:Images')->findAll();

        return $this->render('images/index.html.twig', array(
            'images' => $images,
        ));
    }

    /**
     * Creates a new image entity.
     *
     * @Route("/new", name="images_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $image = new Image();
        $form = $this->createForm('AppBundle\Form\ImagesType', $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();

            return $this->redirectToRoute('images_show', array('id' => $image->getId()));
        }

        return $this->render('images/new.html.twig', array(
            'image' => $image,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a image entity.
     *
     * @Route("/{id}", name="images_show")
     * @Method("GET")
     */
    public function showAction(Images $image)
    {
        $deleteForm = $this->createDeleteForm($image);

        return $this->render('images/show.html.twig', array(
            'image' => $image,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing image entity.
     *
     * @Route("/{id}/edit", name="images_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Images $image)
    {
        $deleteForm = $this->createDeleteForm($image);
        $editForm = $this->createForm('AppBundle\Form\ImagesType', $image);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('images_edit', array('id' => $image->getId()));
        }

        return $this->render('images/edit.html.twig', array(
            'image' => $image,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a image entity.
     *
     * @Route("/{id}", name="images_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Images $image)
    {
        $form = $this->createDeleteForm($image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($image);
            $em->flush();
        }

        return $this->redirectToRoute('images_index');
    }

    /**
     * Creates a form to delete a image entity.
     *
     * @param Images $image The image entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Images $image)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('images_delete', array('id' => $image->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
