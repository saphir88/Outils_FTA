<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Communaute;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\Mailer;
/**
 * ValidationCommunaute controller.
 * @Security("has_role('ROLE_ADMIN')", message="Accés réservé à l'administrateur. Si vous êtes l'administrateur de ce site, merci de vous authentifiez")
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
        $communautes = $em->getRepository('AppBundle:Communaute')->findAllValidFalse();

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
    public function showAction(Communaute $communaute)
    {

        return $this->render('validationCommunautes/show.html.twig', array(
            'communaute' => $communaute
        ));
    }

    /**
     * @Route("/delete", name="validation_delete")
     * @Method("POST")
     */
    public function delete(Mailer $mailer)
    {
        $id = $_POST['id'];
        //$logo = "uploads/img/".$_POST['logo'];

        $this->getDoctrine()->getManager()->getRepository('AppBundle:Communaute')->delete($id);
        //unlink($logo);
        // appel du service Mailer
        $mail = $_POST['mail'];
        $mailer->sendEmailRefus($mail);

        return $this->redirectToRoute('validation_index');


    }

    /**
     * @Route("/validate", name="validation_validate")
     * @Method("POST")
     */
    public function validate(Mailer $mailer)
    {

        $id = $_POST['id'];
        $this->getDoctrine()->getManager()->getRepository('AppBundle:Communaute')->validate($id);

        $mail = $_POST['mail'];
        // appel du service Mailer
        $mailer->sendEmailValidate($mail);



        return $this->redirectToRoute('validation_index');
    }

}
