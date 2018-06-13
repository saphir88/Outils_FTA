<?php

namespace Upload\UploadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UploadBundle:Default:index.html.twig');
    }
}
