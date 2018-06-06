<?php

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Repository\CommunauteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Communaute;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use AppBundle\Service\Youtube;



/**
 * Compte controller.
 *
 * @Route("monCompte")
 */
class CompteController extends Controller
{
    /**
     * Page compte
     *
     * @Route("/", name="compte")
     * @Method({"GET", "POST"})
     */
    public function compte(Request $request, Youtube $youtube)
    {

        $communaute = $this->getUser()->getCommunaute();
        $video = $this->getUser()->getCommunaute()->getVideo();

        $deleteForm = $this->createDeleteForm($communaute);
        $form = $this->createForm('AppBundle\Form\CommunauteType', $communaute);
        $form->remove('validation');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $replace = $youtube->replaceVideo($video);
            $communaute->setVideo($replace);

            $em = $this->getDoctrine()->getManager();
            $em->persist($communaute);
            $em->flush();

            return $this->redirectToRoute('compte');
        }

        return $this->render('compte/index.html.twig', array(
            'communaute' => $communaute,
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     *
     * @Route("/gestion_admin", name="gestion_admin")
     * @Method({"GET", "POST"})
     */
    public function gestionAdmin(Request $request)
    {

        $communaute = $this->getUser();

        /* $form = $this->createForm('AppBundle\Form\CommunauteType', $communaute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($communaute);
            $em->flush();

            return $this->redirectToRoute('gestion_admin');
        }*/

        return $this->render('admin/gestion.html.twig', array(
            'utilisateur' => $communaute,
            //'form' => $form->createView(),
        ));

    }

    /**
     * Deletes a communaute entity.
     *
     * @Route("/{id}", name="compte_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Communaute $communaute)
    {
        $form = $this->createDeleteForm($communaute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($communaute);
            $em->flush();
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
