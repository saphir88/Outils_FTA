<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Participation;

/**
 * Startup controller.
 *
 * @Route("evenement")
 */
class EvenementController extends Controller
{
    /**
     * @Route("/", name="evenement")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('AppBundle:Event')->findLastEvent();
        $date = $event[0]->getDate();
        $jour = $date->format('d-m-Y');

        $heure = $date->format('H');
        $minute = $date->format('i');

        $heure = $heure.'h'.$minute;
        $date = $date->format('d-m-Y H:i');

        $event[0]->setDate($date);
        $eventId=$event[0]->getId();

        $participations = $em->getRepository('AppBundle:Participation')->findBy(['event' => $eventId]);

        return $this->render('evenement/evenement.html.twig', array(
            'event' => $event,
            'jour' => $jour,
            'heure' => $heure,
            'participations' => $participations,
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
}
