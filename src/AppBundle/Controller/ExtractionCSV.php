<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 06/06/18
 * Time: 10:12
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * ExtractionCSV controller.
 *
 * @Route("extraction")
 */
class ExtractionCSV extends Controller
{
    /**
     * Extraction en CSV par domaine
     *
     * @Route("/", name="index_extraction")
     * @Method({"GET", "POST"})
     */
    public function indexAction()
    {
        if(isset($_POST['categorie'])) {
            $categorie = $_POST['categorie'];
            $em = $this->getDoctrine()->getManager();

            if ($categorie == "all") {
                $dataExport = $em->getRepository('AppBundle:Communaute')->findAll();
            } else {
                $dataExport = $em->getRepository('AppBundle:Communaute')->findAllByCategory($categorie);
            }
            $test[] = "Startup;Nom du Contact;Mail;Telephone;Domaine";
            foreach($dataExport as $key => $value) {
                $test[] = "\n".'"'.$dataExport[$key]->getNomStartup().'";"'.$dataExport[$key]->getNomContact().'";"'.$dataExport[$key]->getMail().'";"'.$dataExport[$key]->getTelephone().'";"'.$dataExport[$key]->getCategorie().'"';
            }
            $test2= implode("",$test);

            $filename = $categorie."_startups_export.csv";
            $filename = str_replace(" ", "_", $filename);
            $response = new Response($test2);
            $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
            $response->headers->set('Content-Disposition',"attachment; filename=$filename");

            return $response;

        } else {
        return $this->render('extractionCSV/index.html.twig');
        }

    }
}