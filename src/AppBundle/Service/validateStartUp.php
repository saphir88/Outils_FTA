<?php

namespace AppBundle\Service;
use AppBundle\Entity\Communaute;

class validateStartUp
{
    private $validateStartUp;
    private $templating;

    /**
     * Mailer constructor.
     * @param $InscriptionMailer
     */
    public function __construct(\Swift_Mailer $validateStartUp, \Twig_Environment $templating)
    {
        $this->validateStartUp = $validateStartUp;
        $this->templating = $templating;
    }


    public function sendEmailValidate($email){

        $body = $this->templating->render('email/validateStartUp.html.twig',[
            'email'=>$email,
        ]);
        //$sendAllMails =
        $message = (new\Swift_Message('validateStartUp'))
            ->setFrom('axelfertinel@gmail.com')
            ->setTo($email)
            ->setBody($body, 'text/html');
        $this->validateStartUp->send($message);

    }

}