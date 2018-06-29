<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;


/**
 * Login controller.
 * @Security("has_role('ROLE_ADMIN')", message="Accés réservé à l'administrateur. Si vous êtes l'administrateur de ce site, merci de vous authentifiez")
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
}
