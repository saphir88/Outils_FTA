<?php
namespace AppBundle\Service;

/**
 * Class Mailer
 * @package AppBundle\Service
 */
class Mailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Modèle du mail
     */
    private $templating;

    /**
     * Mailer constructor.
     * @param \Swift_Mailer $mailer
     * @param \Twig_Environment $templating
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    /**
     * Envoi d'un mail.
     *
     * @param $nom
     * @param $email
     * @param $message
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendEmail($nom, $email, $message)
    {
        $body = $this->templating->render('email/send.html.twig',[
            'nom' => $nom,
            'email' => $email,
            'message' => $message,
        ]);

        $message = (new\Swift_Message('infocontact'))
            ->setFrom($email)
            ->setTo('axelfertinel@gmail.com')
            ->setBody($body, 'text/html');

        $this->mailer->send($message);
    }

    /**
     * Envoi d'un mail lors de la validation d'une startup par l'admin.
     *
     * @param $email
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendEmailValidate($email){
        $body = $this->templating->render('email/validateStartUp.html.twig',[
            'email' => $email,
        ]);

        $message = (new\Swift_Message('validateStartUp'))
            ->setFrom('axelfertinel@gmail.com')
            ->setTo($email)
            ->setBody($body, 'text/html');

        $this->mailer->send($message);
    }

    /**
     * Envoi d'un mail lors du refus d'une startup par l'admin.
     *
     * @param $email
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendEmailRefus($email){
        $body = $this->templating->render('email/refusStartUp.html.twig',[
            'email' => $email,
        ]);

        $message = (new\Swift_Message('RefusStartUp'))
            ->setFrom('axelfertinel@gmail.com')
            ->setTo($email)
            ->setBody($body, 'text/html');

        $this->mailer->send($message);
    }

    /**
     * Envoi d'un mail lors de la suppression d'une startup par l'admin.
     *
     * @param $email
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendEmailSuppression($email){
        $body = $this->templating->render('email/suppressionStartUp.html.twig',[
            'email' => $email,
        ]);

        $message = (new\Swift_Message('suppressionStartUp'))
            ->setFrom('axelfertinel@gmail.com')
            ->setTo($email)
            ->setBody($body, 'text/html');

        $this->mailer->send($message);
    }
}