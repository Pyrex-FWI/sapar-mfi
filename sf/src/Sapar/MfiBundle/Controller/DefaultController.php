<?php

namespace Sapar\MfiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SaparMfiBundle:Default:index.html.twig');
    }
}
