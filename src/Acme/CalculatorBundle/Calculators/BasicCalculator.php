<?php
namespace Acme\CalculatorBundle\Calculators;

class OPERATION {
    const ADD       = "add";
    const SUBTRACT  = "subtract";
    const MULTIPLY  = "multiply";
    const DIVIDE    = "divide";
}

class BasicCalculator {
    private $opt, $op1 , $op2;
    
    public function __construct($opt, $op1, $op2){
	    $this->opt = $opt;
        $this->op1 = $op1;
        $this->op2 = $op2;
    }

    public function execute(){
	$result = 0;
      /*
        switch ($this->opt){
	    case OPERATION::ADD:
		$result = $this->add();
		break;
	    case OPERATION::SUBTRACT:
		$result = $this->subtract();
		break;
	    case OPERATION::MULTIPLY:
		$result = $this->multiply();
		break;
	    case OPERATION::DIVIDE:
		$result = $this->divide();
		break;
	    default:
		$result = 0;
	}
    */
    $method = $this->opt;
    $result = $this->$method();
	return $result;
    }

    public function add(){
        return $this->op1 + $this->op2;
    }

    public function subtract(){
        return $this->op1 - $this->op2;
    }

    public function multiply (){
        return $this->op1 * $this->op2;
    }

    public function divide () {
        return $this->op1 / $this->op2;
    }

}

?>
