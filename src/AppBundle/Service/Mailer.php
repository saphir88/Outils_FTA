<?php

namespace AppBundle\Service;


class Mailer
{
    private $mailer;
    private $templating;

    /**
     * Mailer constructor.
     * @param $mailer
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }


    public function sendEmail($nom,$email,$message){

        $body = $this->templating->render('email/send.html.twig',[
            'nom'=>$nom,
            'email'=>$email,
            'message'=>$message,
        ]);
        //$sendAllMails =
        $message = (new\Swift_Message('infocontact'))
            ->setFrom($email)
            ->setTo('axelfertinel@gmail.com')
            ->setBody($body, 'text/html');
        $this->mailer->send($message);

    }
}