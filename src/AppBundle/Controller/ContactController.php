<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\Mailer;


/**
 * Contact controller.
 *
 * @Route("contact")
 */
class ContactController extends Controller
{
    /**
     * Creates a new contact entity.
     *
     * @Route("/", name="contact_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Mailer $mailer)
    {
        $contact = new Contact();
        $form = $this->createForm('AppBundle\Form\ContactType', $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            $mailer->sendEmail($contact->getNom(),$contact->getEmail(),$contact->getMessage());

            $this->addFlash('success', 'Votre message à bien été envoyé.');

            return $this->redirectToRoute('contact_new');
        }

        return $this->render('contact/new.html.twig', array(
            'contact' => $contact,
            'form' => $form->createView(),
        ));
    }

    /*
     * Ci dessous les méthodes concernant les "contacts" (en cas de besoin)
     */

//
//    /**
//     * Finds and displays a contact entity.
//     *
//     * @Route("/{id}", name="contact_show")
//     * @Method("GET")
//     */
//    public function showAction(Contact $contact)
//    {
//        $deleteForm = $this->createDeleteForm($contact);
//
//        return $this->render('contact/show.html.twig', array(
//            'contact' => $contact,
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }
//
//    /**
//     * Displays a form to edit an existing contact entity.
//     * @Security("has_role('ROLE_ADMIN')", message="Accés réservé à l'administrateur. Si vous êtes l'administrateur de ce site, merci de vous authentifiez")
//     * @Route("/{id}/edit", name="contact_edit")
//     * @Method({"GET", "POST"})
//     */
//    public function editAction(Request $request, Contact $contact)
//    {
//        $deleteForm = $this->createDeleteForm($contact);
//        $editForm = $this->createForm('AppBundle\Form\ContactType', $contact);
//        $editForm->handleRequest($request);
//
//        if ($editForm->isSubmitted() && $editForm->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('contact_edit', array('id' => $contact->getId()));
//        }
//
//        return $this->render('contact/edit.html.twig', array(
//            'contact' => $contact,
//            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }
//
//    /**
//     * Deletes a contact entity.
//     * @Security("has_role('ROLE_ADMIN')", message="Accés réservé à l'administrateur. Si vous êtes l'administrateur de ce site, merci de vous authentifiez")
//     * @Route("/{id}", name="contact_delete")
//     * @Method("DELETE")
//     */
//    public function deleteAction(Request $request, Contact $contact)
//    {
//        $form = $this->createDeleteForm($contact);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($contact);
//            $em->flush();
//        }
//
//        return $this->redirectToRoute('contact_index');
//    }
//
//    /**
//     * Creates a form to delete a contact entity.
//     *
//     * @param Contact $contact The contact entity
//     *
//     * @return \Symfony\Component\Form\Form The form
//     */
//    private function createDeleteForm(Contact $contact)
//    {
//        return $this->createFormBuilder()
//            ->setAction($this->generateUrl('contact_delete', array('id' => $contact->getId())))
//            ->setMethod('DELETE')
//            ->getForm()
//            ;
//    }
}
