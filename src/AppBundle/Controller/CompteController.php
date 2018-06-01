<?php

namespace AppBundle\Controller;

use AppBundle\Repository\CompteRepository;
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

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($communaute);
            $em->flush();

            return $this->redirectToRoute('compte');
        }

        return $this->render('compte/index.html.twig', array(
            'utilisateur' => $communaute,
            'form' => $form->createView(),
        ));

    }
    /**
     * @Route("/replace", name="replace_youtube")
     * @Method("POST")
     */
    public function replaceVideo()
    {
        $video = $this->getUser()->getVideo();
        $youtubeWatch = array("https://www.youtube.com/watch?v=");
        $youtubeEmbed   = array("https://www.youtube.com/embed/");
        $replace= str_replace($youtubeWatch, $youtubeEmbed , $video);
        $id = $_POST['id'];

        $this->getDoctrine()->getRepository('AppBundle:Communautes')->modifier($id,$replace);

        return $this->redirectToRoute('compte');
    }

}
