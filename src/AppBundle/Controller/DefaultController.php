<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/app/{name}", name="homepage")
     */
    public function testAction($name)
    {
        return $this->render('default/index.html.twig');
    }


    /**
     * @Route("/hello/{name}.{_format}",
     *     defaults = {"_format"="html"},
     *     requirements = { "_format" = "html|xml|json" },
     *     name = "hello"
     * )
     */

    public function helloAction($name, $_format)
    {
        return $this->render('default/hello.'.$_format.'.twig', array(
           'name' => $name
          ));
    }
}
