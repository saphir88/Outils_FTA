<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use Proxies\__CG__\AppBundle\Entity\Communaute;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Participant;
use AppBundle\Service\Mailer;

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
    public function indexAction(Request $request, Mailer $mailer)
    {
        $evenementId = $request->query->get('id');
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('AppBundle:Event')->findOneBy(['id' => $evenementId]);

        $today = new \DateTime('now');

        /* -------Inscription des participant------- */

        $participant = new participant();
        $form = $this->createForm('AppBundle\Form\ParticipantType', $participant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $participant->setEvent($event);
            $mail = $participant->getMail();

            if ($this->getDoctrine()->getManager()->getRepository(Participant::class)->findOneBy([
                'event' => $evenementId,
                'mail' => $mail
            ])) {
                $this->addFlash('error', "Vous êtes déjà inscrit à cet événement !");
            } else {
                $em = $this->getDoctrine()->getManager();
                $participant->setNom(ucfirst(strtolower($participant->getNom())));
                $participant->setPrenom(ucfirst(strtolower($participant->getPrenom())));

                $mailer->sendEmailEvenement($participant->getMail(), $event->getDate(), $event->getTitre(), $event->getLocalisation());

                $em->persist($participant);
                $em->flush();

                $this->addFlash('success', "Votre inscription à cet événement a bien été prise en compte !");

                return $this->redirectToRoute('evenement', ["id" => $evenementId]);
            }
        }
        /* -------FIN------ */

        if($event == []){
            return $this->render('evenement/evenement.html.twig');
        }


        $participations = $em->getRepository('AppBundle:Participation')->findBy(['event' => $evenementId]);
        $participantInscrit = $em->getRepository('AppBundle:Participant')->findBy(['event' => $evenementId]);
        $nbInscrit = count($participantInscrit);

        return $this->render('evenement/evenement.html.twig', array(
            'event' => $event,
            'today' => $today,
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
        $evenementId = $_POST['eventId'];

        $id = $_POST['vote'];
        setcookie($id,"vote_startup",time() + 60*24*3600);
        if(!isset($_COOKIE[$id])) {
            $this->getDoctrine()->getManager()->getRepository('AppBundle:Participation')->addVote($id);
            $this->addFlash('success', 'Votre vote a bien été pris en compte !');
        } else {
            $this->addFlash('error', "Vous avez déjà voté pour cette Startup !");
        }

        return $this->redirectToRoute('evenement', ["id" => $evenementId]);
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/archive" , name="event_archive")
     * @Method("GET")
     */
    public function archives()
    {
        $now = new \DateTime('now');
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('AppBundle:Event')->findAllEventPast();


        return $this->render("evenement/allEvenement.html.twig", [
            "events" => $events,
            "dateNow" => $now,
        ]);
    }

    /*---- Récuperation des évènements passés ----*/
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/prochain", name="event_to_come")
     * @Method("GET")
     */
    public function eventToCome()
    {
        $now = new \DateTime('now');
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('AppBundle:Event')->findAllEventToCome();


        return $this->render("evenement/allEvenement.html.twig", [
            "events" => $events,
            "dateNow" => $now,
        ]);
    }


}
