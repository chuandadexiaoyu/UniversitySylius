<?php

namespace Sylius\Bundle\UniversityAddressingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SyliusUniversityAddressingBundle:Default:index.html.twig', array('name' => $name));
    }
}
