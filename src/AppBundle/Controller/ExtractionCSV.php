<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 06/06/18
 * Time: 10:12
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * ExtractionCSV controller.
 * @Security("has_role('ROLE_ADMIN')", message="Accès réservé à l'administrateur. Si vous êtes l'administrateur de ce site, merci de vous authentifier")
 * @Route("extraction")
 */
class ExtractionCSV extends Controller
{
    /**
     * Extraction des Startups (en CSV) par Domaine
     *
     * @Route("/", name="startup_extraction")
     * @Method({"GET","POST"})
     */
    public function CSVStartups()
    {
        if(isset($_POST['categorie'])) {
            $categorie = $_POST['categorie'];
            $em = $this->getDoctrine()->getManager();

            if ($categorie == "") {
                $dataExport = $em->getRepository('AppBundle:Communaute')->findAllValidTrue();
                $categorie = "all";
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
            return $this->render('communaute/index.html.twig');
        }
    }

    /**
     * Extraction des Participants (en CSV) par évenement
     *
     * @Route("/participants", name="participant_extraction")
     * @Method("POST")
     */
    public function CSVParticipants()
    {
            $event = $_POST['event'];
            $em = $this->getDoctrine()->getManager();
            $dataExport = $em->getRepository('AppBundle:Participant')->findBy(
                ['event' => $event]
            );

            $test[] = "Nom;Prénom;Mail;Société;Statut";
            foreach($dataExport as $key => $value) {
                $test[] = "\n".'"'.$dataExport[$key]->getNom().'";"'.$dataExport[$key]->getPrenom().'";"'.$dataExport[$key]->getMail().'";"'.$dataExport[$key]->getSociete().'";"'.$dataExport[$key]->getStatut().'"';
            }
            $test2= implode("",$test);

            $filename = $event."_participants_export.csv";
            $filename = str_replace(" ", "_", $filename);
            $response = new Response($test2);
            $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
            $response->headers->set('Content-Disposition',"attachment; filename=$filename");

            return $response;
    }

    /**
     * Extraction des Participants (en CSV) par évenement
     *
     * @Route("/investisseurs", name="investisseur_extraction")
     * @Method("POST")
     */
    public function CSVInvestisseurs()
    {
        $event = $_POST['event'];
        $statut = 'Investisseur';
        $em = $this->getDoctrine()->getManager();
        $dataExport = $em->getRepository('AppBundle:Participant')->findBy(
            ['event' => $event, 'statut' => $statut]
        );

        $test[] = "Nom;Prénom;Mail;Société";
        foreach($dataExport as $key => $value) {
            $test[] = "\n".'"'.$dataExport[$key]->getNom().'";"'.$dataExport[$key]->getPrenom().'";"'.$dataExport[$key]->getMail().'";"'.$dataExport[$key]->getSociete().'"';
        }
        $test2= implode("",$test);

        $filename = $event."_investisseurs_export.csv";
        $filename = str_replace(" ", "_", $filename);
        $response = new Response($test2);
        $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
        $response->headers->set('Content-Disposition',"attachment; filename=$filename");

        return $response;
    }
}