<?php
// src/Acme/CalculatorBundle/Controller/CalculatorController.php
namespace Acme\CalculatorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Acme\CalculatorBundle\Calculators\BasicCalculator;

class CalculatorController extends Controller
{
    /**
     * @Route("/calculator/main", name="mainUI")
     */
    public function indexAction()
    {
	return $this->render(
	   'AcmeCalculatorBundle:Calculator:index.html.twig'
	);
    }
    public function calculateAction($opt, $op1, $op2)
    {
  	$basicCal = new BasicCalculator($opt, $op1, $op2);
	$result = $basicCal->execute();
	return $this->render(
	    'AcmeCalculatorBundle:Calculator:calculate.html.twig',
	    array('result' => $result)
	);
    }
    
}
