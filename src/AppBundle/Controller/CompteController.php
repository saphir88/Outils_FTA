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
use Symfony\Component\PropertyAccess\PropertyAccess;

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
        $id = $this->getUser()->getId();

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);

        $communaute = $user->getCommunaute();

        $deleteForm = $this->createDeleteForm($communaute);
        $editForm = $this->createForm('AppBundle\Form\CommunauteType', $communaute);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            if($communaute->getVideo() !== null){
                $replace = $youtube->replaceVideo($communaute->getVideo());
                $communaute->setVideo($replace);
            }


            $em = $this->getDoctrine()->getManager();
            $em->persist($communaute);
            $em->flush();

            return $this->redirectToRoute('compte');
        }

        return $this->render('compte/index.html.twig', array(
            'communaute' => $communaute,
            'edit_form' => $editForm->createView(),
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

        dump($communaute);
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
