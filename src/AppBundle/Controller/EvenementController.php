<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Participant;

/**
 * Startup controller.
 *
 * @Route("evenement")
 */
class EvenementController extends Controller
{
    /**
     * @Route("/", name="evenement")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('AppBundle:Event')->findLastEvent();

        $participant = new participant();
        $form = $this->createForm('AppBundle\Form\ParticipantType', $participant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $participant->setEvent($event[0]);
            $em = $this->getDoctrine()->getManager();
            $em->persist($participant);
            $em->flush();

            return $this->redirectToRoute('evenement');
        }

        $date = $event[0]->getDate();
        $jour = $date->format('d-m-Y');
        $heure = $date->format('H');
        $minute = $date->format('i');
        $heure = $heure.'h'.$minute;
        $date = $date->format('d-m-Y H:i');
        $event[0]->setDate($date);
        $eventId=$event[0]->getId();


        $participations = $em->getRepository('AppBundle:Participation')->findBy(['event' => $eventId]);
        $participantInscrit = $em->getRepository('AppBundle:Participant')->findAll();
        $nbInscrit = count($participantInscrit);

        return $this->render('evenement/evenement.html.twig', array(
            'event' => $event,
            'jour' => $jour,
            'heure' => $heure,
            'form' => $form->createView(),
            'participations' => $participations,
            'participantInscrit' => $participantInscrit,
            'nbInscrit' => $nbInscrit,
        ));
    }

    /**
     * Recupère l'id de la participation et lui ajoute un vote lorsque l'on appuie sur le bouton "+" qui lui est associé
     *
     * @Route("/vote", name="vote")
     * @Method("POST")
     */
    public function Vote()
    {
        $id = $_POST['vote'];
        setcookie($id,"vote_startup",time() + 60*24*3600);
        if(!isset($_COOKIE[$id])) {
            $this->getDoctrine()->getManager()->getRepository('AppBundle:Participation')->addVote($id);
            $this->addFlash('success', 'Votre vote a bien été pris en compte !');
        } else {
            $this->addFlash('success', 'Vous avez déjà voté pour cette Startup !');
        }

        return $this->redirectToRoute('evenement');
    }

    /**
     *
     * @Route("/inscription", name="inscription_event")
     */
    public function inscription()
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('AppBundle:Event')->findLastEvent();


            $eventId = $request->request->get('eventId');
            $eventA = $this->getDoctrine()->getManager()->getRepository(Event::class)->find($eventId);

            $participant->setEvent($eventA);
            dump($participant);die;
            $em = $this->getDoctrine()->getManager();
            $em->persist($participant);
            $em->flush();

            $this->addFlash('sucess', 'Inscription bien prise en compte.');

            return $this->redirectToRoute('evenement');

    }
}
