<?php
// src/Acme/CalculatorBundle/Controller/CalculatorController.php
namespace Acme\CalculatorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Acme\CalculatorBundle\Calculators\BasicCalculator;

class CalculatorController extends Controller
{
    public function indexAction($opt, $op1, $op2)
    {
  	$basicCal = new BasicCalculator($opt, $op1, $op2);
	$result = $basicCal->execute();
	return $this->render(
	    'AcmeCalculatorBundle:Calculator:index.html.twig',
	    array('result' => $result)
	);
        //return new Response(
        //    '<html><body>Number: </body></html>'
        //); 
    }
    
}
