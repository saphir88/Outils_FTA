<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Communautes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


/**
 * Compte controller.
 *
 * @Route("profil")
 */
class CompteController extends Controller
{
    /**
     * Page compte
     *
     * @Route("/", name="compte")
     * @Method({"GET", "POST"})
     */
    public function compte(Request $request)
    {

        $communaute = $this->getUser();

        $form = $this->createForm('AppBundle\Form\CommunautesType', $communaute);
        $form->handleRequest($request);

        $video = $this->getUser()->getVideo();
        $Youtube = array("https://www.youtube.com/watch?v=");
        $replace   = array("https://www.youtube.com/embed/");
        $test= str_replace($Youtube, $replace, $video);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($communaute);
            $em->flush();

            return $this->redirectToRoute('compte');

        }

        return $this->render('compte/index.html.twig', array(
            'utilisateur' => $communaute,
            'form' => $form->createView(),
            'video'=> $video,
            'test'=>$test,


        ));
    }

    /**
     * @Route("/delete", name="compte_delete")
     * @Method("POST")
     */
    public function delete()
    {
        $id = $_POST['id'];
        $this->getDoctrine()->getManager()->getRepository('AppBundle:Communautes')->delete($id);

        return $this->redirectToRoute('homepage');
    }

}
