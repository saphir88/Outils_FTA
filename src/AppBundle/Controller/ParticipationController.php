<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Communaute;
use AppBundle\Entity\Event;
use AppBundle\Entity\Participation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Participation controller.
 *
 * @Route("participation")
 */
class ParticipationController extends Controller
{
    /**
     * Lists all participation entities.
     *
     * @Route("/", name="participation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $participations = $em->getRepository('AppBundle:Participation')->findAll();

        return $this->render('participation/index.html.twig', array(
            'participations' => $participations,
        ));
    }

    /**
     *
     * @Route("/", name="inscriptionStartUp")
     * @Method("POST")
     */
    public function inscriptionStartUpAction(Request $request)
    {
        $communaute = $this->getUser()->getCommunaute();

        $validation = $communaute->isValidation();

        if($validation == '1') {
            $eventId = $request->request->get('eventId');
            $event = $this->getDoctrine()->getManager()->getRepository(Event::class)->find($eventId);
            $communauteId = $communaute->getId();

            if ($this->getDoctrine()->getManager()->getRepository(Participation::class)->findOneBy([
                'event' => $eventId,
                'communaute' => $communauteId
            ])) {
                $this->addFlash('notice', "Votre Startup est déjà inscrite à cet événement !");
            } else {
                $p = new Participation();
                $p->setEvent($event);
                $p->setCommunaute($communaute);
                $p->setNbVote('0');

                $em = $this->getDoctrine()->getManager();
                $em->persist($p);
                $em->flush();

                $this->addFlash('success', "Votre Startup vient d'être inscrite à cet événement !");
            }
        } else {

            $this->addFlash('notice', "Votre Startup n'a pas encore été validée par l'administrateur.");

        }

        return $this->redirectToRoute('evenement');
        
    }
    /**
     * Creates a new participation entity.
     *
     * @Route("/new", name="participation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $participation = new Participation();
        $form = $this->createForm('AppBundle\Form\ParticipationType', $participation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($participation);
            $em->flush();

            return $this->redirectToRoute('participation_show', array('id' => $participation->getId()));
        }

        return $this->render('participation/new.html.twig', array(
            'participation' => $participation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a participation entity.
     *
     * @Route("/{id}", name="participation_show")
     * @Method("GET")
     */
    public function showAction(Participation $participation)
    {
        $deleteForm = $this->createDeleteForm($participation);

        return $this->render('participation/show.html.twig', array(
            'participation' => $participation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing participation entity.
     *
     * @Route("/{id}/edit", name="participation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Participation $participation)
    {
        $deleteForm = $this->createDeleteForm($participation);
        $editForm = $this->createForm('AppBundle\Form\ParticipationType', $participation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('participation_edit', array('id' => $participation->getId()));
        }

        return $this->render('participation/edit.html.twig', array(
            'participation' => $participation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a participation entity.
     *
     * @Route("/{id}", name="participation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Participation $participation)
    {
        $form = $this->createDeleteForm($participation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($participation);
            $em->flush();
        }

        return $this->redirectToRoute('participation_index');
    }

    /**
     * Creates a form to delete a participation entity.
     *
     * @param Participation $participation The participation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Participation $participation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('participation_delete', array('id' => $participation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
