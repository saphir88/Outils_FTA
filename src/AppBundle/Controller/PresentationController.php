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
 * @Route("presentation")
 */
class PresentationController extends Controller
{
    /**
     * @Route("/", name="presentation")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $communautes = $em->getRepository('AppBundle:Communaute')->findAllValidTrue();
        // replace this example code with whatever you need
        return $this->render('Presentation/presentation.html.twig',array(
            'communautes' => $communautes,
        ));
    }

}
