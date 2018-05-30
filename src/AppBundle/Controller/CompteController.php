<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     * @Method("GET")
     */
    public function compte()
    {
        $infos[] = ""; //Stockage des futures informations du compte de la startup

        // TODO

        return $this->render('compte/index.html.twig', ['infos' => $infos,]);
    }

}
