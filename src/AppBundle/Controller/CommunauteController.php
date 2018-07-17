<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Communaute;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\Youtube;
use AppBundle\Entity\User;
use AppBundle\Repository\CommunauteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use AppBundle\Service\Mailer;


/**
 * Communaute controller.
 * @Route("communaute")
 */
class CommunauteController extends Controller
{
    /**
     * Lists all communaute entities.
     * @Security("has_role('ROLE_ADMIN')", message="Accés réservé à l'administrateur. Si vous êtes l'administrateur de ce site, merci de vous authentifiez")
     * @Route("/modif", name="communaute_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $communautes = $em->getRepository('AppBundle:Communaute')->findAllValidTrue();


        return $this->render('communaute/index.html.twig', array(
            'communautes' => $communautes,

        ));
    }

    /**
     * Displays a form to edit an existing communaute entity.
     * @Security("has_role('ROLE_ADMIN')", message="Accés réservé à l'administrateur. Si vous êtes l'administrateur de ce site, merci de vous authentifiez")

     * @Route("/{id}/edit", name="communaute_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Communaute $communaute, Youtube $youtube)
    {

        $deleteForm = $this->createDeleteForm($communaute);
        $editForm = $this->createForm('AppBundle\Form\CommunauteType', $communaute);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
                //appel du service youtube.
            if($communaute->getVideo() !== null){
                $replace = $youtube->replaceVideo($communaute->getVideo());
                $communaute->setVideo($replace);
            }

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('communaute_edit', array('id' => $communaute->getId()));
        }

        return $this->render('communaute/edit.html.twig', array(
            'communaute' => $communaute,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a communaute entity.
     *
     * @Route("/{id}", name="communaute_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Communaute $communaute,Mailer $mailer)
    {
        $form = $this->createDeleteForm($communaute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($communaute);
            $em->flush();
            // envoye de mail
            $mailer->sendEmailSuppression($communaute->getMail());
        }

        return $this->redirectToRoute('communaute_index');
    }

    /**
     * Creates a form to delete a communaute entity.
     *
     * @param Communaute $communaute The communaute entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Communaute $communaute)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('communaute_delete', array('id' => $communaute->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
