<?php

namespace AppBundle\Service;
use AppBundle\Entity\Communaute;

class suppressionStartUp
{
    private $suppressionStartUp;
    private $templating;

    /**
     * Mailer constructor.
     * @param $suppressionStartUp
     */
    public function __construct(\Swift_Mailer $suppressionStartUp, \Twig_Environment $templating)
    {
        $this->suppressionStartUp = $suppressionStartUp;
        $this->templating = $templating;
    }


    public function sendEmailsuppression($email){

        $body = $this->templating->render('email/suppressionStartUp.html.twig',[
            'email'=>$email,
        ]);
        //$sendAllMails =
        $message = (new\Swift_Message('suppressionStartUp'))
            ->setFrom('axelfertinel@gmail.com')
            ->setTo($email)
            ->setBody($body, 'text/html');
        $this->suppressionStartUp->send($message);

    }

}