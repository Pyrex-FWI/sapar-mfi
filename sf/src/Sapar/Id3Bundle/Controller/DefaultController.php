<?php

namespace Sapar\Id3Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SaparId3Bundle:Default:index.html.twig');
    }
}
