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
        // return $this->render('default/index.html.twig');
	 return $this->redirectToRoute('hello', array('name' => 'steven'));
	//throw $this->createNotFoundException();
	//throw new \Exception('Something went horribly wrong!');
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

    /**
     * @Route("/add/{op1}/{op2}")
     */
    public function addAction($op1, $op2)
    {
	    $result = $op1 + $op2;
	    return $this->render('default/add.html.twig', array(
	    'result' => $result,
	    ));
    }
}
