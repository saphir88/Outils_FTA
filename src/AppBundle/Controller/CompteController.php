<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Communautes;
use AppBundle\Entity\User;
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
    protected $errors = [];

    /**
     * Page compte
     *
     * @Route("/", name="compte")
     * @Method({"GET", "POST"})
     */
    public function compte(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm('AppBundle\Form\CommunautesType', $user);
        $form->handleRequest($request);

        $video = $this->getUser()->getVideo();
        $Youtube = array("https://www.youtube.com/watch?v=");
        $replace   = array("https://www.youtube.com/embed/");
        $test= str_replace($Youtube, $replace, $video);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('compte');

        }

        return $this->render('compte/index.html.twig', array(
            'utilisateur' => $user,
            'form' => $form->createView(),
            'video'=> $video,
            'test'=>$test,


        ));

    }

}
