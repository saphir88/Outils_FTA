<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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
        return $this->render('evenement/evenement.html.twig',array(
            'event' => $event,
            'jour' => $jour,
            'heure' => $heure,
        ));
    }

}
