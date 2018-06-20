<?php
namespace AppBundle\Service;

/**
 * Class InscriptionMailer
 * @package AppBundle\Service
 */
class InscriptionMailer
{
    /**
     * @var \Swift_Mailer
     */
    private $inscriptionMailer;

    /**
     * @var Modèle du mail
     */
    private $templating;

    /**
     * InscriptionMailer constructor.
     * @param \Swift_Mailer $inscriptionMailer
     * @param \Twig_Environment $templating
     */
    public function __construct(\Swift_Mailer $inscriptionMailer, \Twig_Environment $templating)
    {
        $this->inscriptionMailer = $inscriptionMailer;
        $this->templating = $templating;
    }

    /**
     * Envoi d'un mail lors de l'inscription d'une startup.
     *
     * @param $nomStartup
     * @param $email
     * @param $message
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendEmailInscription($nomStartup, $email, $message)
    {
        $body = $this->templating->render('email/inscriptionMail.html.twig',[
            'nom' => $nomStartup,
            'email' => $email,
            'message' => $message,
        ]);

        $message = (new \Swift_Message('InscriptionStartUp'))
            ->setFrom($email)
            ->setTo('axelfertinel@gmail.com')
            ->setBody($body, 'text/html');

        $this->inscriptionMailer->send($message);
    }
}