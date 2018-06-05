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
 * Login controller.
 *
 * @Route("admin")
 */
class AdminController extends Controller
{
    protected $errors = [];

    /**
     * Page admin
     *
     * @Route("/", name="admin")
     * @Method("GET")
     */
    public function admin()
    {
            return $this->render('admin/admin.html.twig');
    }

    /**
     * Page login
     *
     * @Route("/login", name="login")
     * @Method({"GET", "POST"})
     */
    public function login()
    {
        if(isset($_SESSION)) {
            $myPseudo = 'admin';
            $myMdp = 'admin';
            if(isset($_POST['username']) && isset($_POST['password'])) {
                if ($_POST['username'] == $myPseudo && $_POST['password'] == $myMdp){
                    $_SESSION['username'] = "admin";
                    return $this->redirectToRoute('admin');
                } else {
                    $this->errors[] = "Identifiant ou mot de passe invalide";
                    return $this->render("admin/login.html.twig", ['errors' => $this->errors,]);
                }
            } else {
                $this->errors[] = "Veuillez entrer vos identifiants";
                return $this->render("admin/login.html.twig", ['errors' => $this->errors,]);
            }
        } else {
            session_start();
            return $this->render('admin/login.html.twig');
        }
    }

    /**
     * Page logout
     *
     * @Route("/logout", name="logout")
     * @Method("GET")
     */
    public function logout()
    {
        session_destroy();
        return $this->redirectToRoute('homepage');
    }

    /**
     * Exportation en CSV
     *
     * @Route("/csv_extract", name="csv_extract")
     * @Method("GET")
     */
    public function exportCSV()
    {
        $em = $this->getDoctrine()->getManager();
        $dataExport = $em->getRepository('AppBundle:Communaute')->findAll();

        $test[] = "Startup;Nom du Contact;Mail;Telephone";
        foreach($dataExport as $key => $value) {
            $test[] = "\n".'"'.$dataExport[$key]->getNomStartup().'";"'.$dataExport[$key]->getNomContact().'";"'.$dataExport[$key]->getMail().'";"'.$dataExport[$key]->getTelephone().'"';
        }
        $test2= implode("",$test);

        $response = new Response($test2);
        $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
        $response->headers->set('Content-Disposition','attachment; filename="startups_export.csv"');

        return $response;

    }
}
