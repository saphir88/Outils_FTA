<?php
namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Repository\CommunauteRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Communaute;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Service\Youtube;


/**
 * Compte controller.
 * @Security("has_role('ROLE_USER')", message="Accés réservé à l'administrateur. Si vous êtes l'administrateur de ce site, merci de vous authentifiez")
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

            /*           foreach($communaute->getImages() as $Image)
                       {
                           $Image->setCommunaute($communaute);
                       }
           */
            $em = $this->getDoctrine()->getManager();
            $em->persist($communaute);


            $em->flush();

            $this->addFlash('success', 'Modifications bien prise en compte.');

            return $this->redirectToRoute('compte');
        }

        return $this->render('compte/index.html.twig', array(
            'communaute' => $communaute,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),

        ));
    }


    /**
     * @Security("has_role('ROLE_ADMIN')", message="Accés réservé à l'administrateur. Si vous êtes l'administrateur de ce site, merci de vous authentifiez")
     * @Route("/gestion_admin", name="gestion_admin")
     * @Method({"GET", "POST"})
     */
    public function gestionAdmin(Request $request)
    {
        return $this->render('admin/admin.html.twig');
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

        return $this->redirectToRoute('homepage');
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
