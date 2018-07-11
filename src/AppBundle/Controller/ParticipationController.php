<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Communaute;
use AppBundle\Entity\Event;
use AppBundle\Entity\Participation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\Mailer;

/**
 * Participation controller.
 *
 * @Route("participation")
 */
class ParticipationController extends Controller
{
    /**
     * Lists all participation entities.
     * @Security("has_role('ROLE_ADMIN')", message="Accés réservé à l'administrateur. Si vous êtes l'administrateur de ce site, merci de vous authentifiez")
     * @Route("/startup", name="participation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $participations = $em->getRepository('AppBundle:Participation')->findAll();
        $deleteFormView=[];
        foreach ($participations as $participation){
            $deleteFormView[] = $this->createDeleteForm($participation)->createView();
        }
        return $this->render('participation/index.html.twig', array(
            'participations' => $participations,
            'delForms' => $deleteFormView
        ));
    }

    /**
     *
     * @Route("/", name="inscriptionStartUp")
     * @Method("POST")
     */
    public function inscriptionStartUpAction(Request $request, Mailer $mailer)
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
                $this->addFlash('error', "Votre Startup est déjà inscrite à cet événement !");
            } else {
                $p = new Participation();
                $p->setEvent($event);
                $p->setCommunaute($communaute);
                $p->setNbVote('0');

                $em = $this->getDoctrine()->getManager();

                $mailer->sendEmailEvenement($communaute->getMail(),$event->getDate(),$event->getTitre(),$event->getLocalisation());

                $em->persist($p);
                $em->flush();

                $this->addFlash('success', "Votre Startup vient d'être inscrite à cet événement !");
            }
        } else {

            $this->addFlash('error', "Votre Startup n'a pas encore été validée par l'administrateur.");

        }

        return $this->redirectToRoute('evenement', array('id' => $event->getId()));
        
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
