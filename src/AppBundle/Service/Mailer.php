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
    //Service utiliser pour contacter la French tech Alsace
    public function sendEmail($nom, $email, $message)
    {
        $body = $this->templating->render('email/send.html.twig',[
            'nom' => $nom,
            'email' => $email,
            'message' => $message,
        ]);

        $message = (new\Swift_Message('infocontact'))
            ->setFrom($email)
            ->setTo('')   //Renseigner l'adresse mail de la FTA
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
    //Email envoyer quand l'admin valide une startup
    public function sendEmailValidate($email){
        $body = $this->templating->render('email/validateStartUp.html.twig',[
            'email' => $email,
        ]);

        $message = (new\Swift_Message('validateStartUp'))
            ->setFrom('') //Renseigner l'adresse mail de la FTA
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
    //EMail envoyer quand la FTA refuse une startup
    public function sendEmailRefus($email){
        $body = $this->templating->render('email/refusStartUp.html.twig',[
            'email' => $email,
        ]);


        $message = (new\Swift_Message('RefusStartUp'))
            ->setFrom('')   //Renseigner l'adresse mail de la FTA
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
    // Email envoyer quand une statup est supprimer par la FTA
    public function sendEmailSuppression($email){
        $body = $this->templating->render('email/suppressionStartUp.html.twig',[
            'email' => $email,
        ]);

        $message = (new\Swift_Message('suppressionStartUp'))
            ->setFrom('') //Renseigner l'adresse mail de la FTA
            ->setTo($email)
            ->setBody($body, 'text/html');

        $this->mailer->send($message);
    }
        /**
     * Envoi d'un mail lors de l'inscription d'une startup.
     * @param $nomStartup
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
        //Email envoyer à la FTA pour lui annoncer qu'un nouvelle startup c'est inscrite
    public function sendEmailInscription()
    {
        $body = $this->templating->render('email/inscriptionMail.html.twig');

        $message = (new \Swift_Message('Nouvelle StartUp inscrite'))
            ->setFrom('')   //Renseigner l'adresse mail de la FTA
            ->setTo('')   //Renseigner l'adresse mail de la FTA

            ->setBody($body, 'text/html');

        $this->mailer->send($message);
    }

    // Email envoyer au participant des evenement pour leur donner la date/heure lieu et titre de l'evemenent.
    public function sendEmailEvenement($email,$date,$titre,$lieu)
    {
        $body = $this->templating->render('email/evenementMail.html.twig',[
            'titre' => $titre,
            'date' => $date,
            'lieu' => $lieu,
    ]);

        $message = (new \Swift_Message('Rappel d\'evenement'))
            ->setFrom('axelfertinel@gmail.com')
            ->setTo($email)
            ->setBody($body, 'text/html');

        $this->mailer->send($message);
    }
}