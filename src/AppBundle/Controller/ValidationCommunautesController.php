<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Communautes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * ValidationCommunaute controller.
 *
 * @Route("validation")
 */
class ValidationCommunautesController extends Controller
{
    /**
     * Lists all communaute entities where they are validated.
     *
     * @Route("/", name="validation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $communautes = $em->getRepository('AppBundle:Communautes')->findAllValidFalse();

        return $this->render('validationCommunautes/index.html.twig', array(
            'communautes' => $communautes,
        ));
    }


    /**
     * Finds and displays a communaute entity.
     *
     * @Route("/{id}", name="validation_show")
     * @Method("GET")
     */
    public function showAction(Communautes $communaute)
    {
        return $this->render('validationCommunautes/show.html.twig', array(
            'communaute' => $communaute
        ));
    }

    /**
     * @Route("/delete", name="validation_delete")
     * @Method("POST")
     */
    public function delete()
    {
        $id = $_POST['id'];
        $logo = "uploads/img/".$_POST['logo'];

        $this->getDoctrine()->getManager()->getRepository('AppBundle:Communautes')->delete($id);
        unlink($logo);

        return $this->redirectToRoute('validation_index');
    }

    /**
     * @Route("/validate", name="validation_validate")
     * @Method("POST")
     */
    public function validate()
    {
        $id = $_POST['id'];
        $this->getDoctrine()->getManager()->getRepository('AppBundle:Communautes')->validate($id);

        return $this->redirectToRoute('validation_index');
    }

}
