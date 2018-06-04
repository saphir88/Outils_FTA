<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\StartUps;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $startUps = $em->getRepository('AppBundle:Communautes')->findAll();
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig',array(
            'startUps' => $startUps,
        ));
    }

}
