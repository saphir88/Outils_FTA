<?php

namespace AppBundle\Controller;

use AppBundle\Entity\communaute;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Startup controller.
 *
 * @Route("Start_ups")
 */
class PresentationController extends Controller
{
    /**
     * @Route("/", name="start_ups")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $communautes = $em->getRepository('AppBundle:Communaute')->findAllValidTrue();
        return $this->render('Presentation/presentation.html.twig',array(
            'communautes' => $communautes,
        ));
    }

}
