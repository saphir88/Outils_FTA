<?php

namespace AppBundle\Service;


class InscriptionMailer
{
    private $InscriptionMailer;
    private $templating;

    /**
     * Mailer constructor.
     * @param $InscriptionMailer
     */
    public function __construct(\Swift_Mailer $InscriptionMailer, \Twig_Environment $templating)
    {
        $this->InscriptionMailer = $InscriptionMailer;
        $this->templating = $templating;
    }


    public function sendEmailInscription($nomStartup,$email,$message){

        $body = $this->templating->render('email/inscriptionMail.html.twig',[
            'nom'=>$nomStartup,
            'email'=>$email,
            'message'=>$message,
        ]);
        //$sendAllMails =
        $message = (new\Swift_Message('InscriptionStartUp'))
            ->setFrom($email)
            ->setTo('axelfertinel@gmail.com')
            ->setBody($body, 'text/html');
        $this->InscriptionMailer->send($message);

    }

}