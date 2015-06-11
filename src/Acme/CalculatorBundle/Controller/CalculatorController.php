<?php
// src/Acme/CalculatorBundle/Controller/CalculatorController.php
namespace Acme\CalculatorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use Acme\CalculatorBundle\Calculators\BasicCalculator;

class CalculatorController extends Controller
{
    /**
     * @Route("/", name="main")
     */
    public function indexAction()
    {
        return $this->render(
	       'AcmeCalculatorBundle:Calculator:index.html.twig'
	);
    }
    public function calculateAction($opt, $op1, $op2)
    {
        $result = "";
        $errorsString = "";

        $basicCal = new BasicCalculator($opt, $op1, $op2);
        $validator = $this->get('validator');
        $errors = $validator->validate($basicCal);
        if (count($errors)) {
            $errorsString = (string) $errors;
        } else {
            $result = $basicCal->execute();    
        }
    
	    return new JsonResponse(array('result' => $result, 'error' => $errorsString));
        
        //return $this->render(
	       //  'AcmeCalculatorBundle:Calculator:calculate.html.twig',
	       //  array('result' => $result)
	       //);
    }
    
}
