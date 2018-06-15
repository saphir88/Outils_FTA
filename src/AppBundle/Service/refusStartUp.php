<?php

namespace AppBundle\Service;
use AppBundle\Entity\Communaute;

class refusStartUp
{
    private $refusStartUp;
    private $templating;

    /**
     * Mailer constructor.
     * @param $suppressionStartUp
     */
    public function __construct(\Swift_Mailer $refusStartUp, \Twig_Environment $templating)
    {
        $this->refusStartUp = $refusStartUp;
        $this->templating = $templating;
    }


    public function sendEmailRefus($email){

        $body = $this->templating->render('email/refusStartUp.html.twig',[
            'email'=>$email,
        ]);
        //$sendAllMails =
        $message = (new\Swift_Message('RefusStartUp'))
            ->setFrom('axelfertinel@gmail.com')
            ->setTo($email)
            ->setBody($body, 'text/html');
        $this->refusStartUp->send($message);

    }

}