<?php
/** 
  * @desc this class will provide server Calculator interface to client
  * @author Steven Liu
  * @date 06/03/2015
*/

namespace Acme\CalculatorBundle\Calculators;

use Symfony\Component\Validator\Constraints as Assert;

class OPERATION {
    const ADD       = "add";
    const SUBTRACT  = "subtract";
    const MULTIPLY  = "multiply";
    const DIVIDE    = "divide";
}

class BasicCalculator {
    
    /**
     * @Assert\Choice(
     *     choices = {"add", "subtract", "multiply","divide"},
     *      message = "invalid operation!"
     * )
     */
    public $opt; // operation string

    /**
     * @Assert\Type(
     *     type="numeric",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $op1; // the first operand

    /**
     * @Assert\Type(
     *     type="numeric",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $op2; // the second operand

    const INFINITE_VALUE = "INF";
    
    public function __construct($opt, $op1, $op2){
	    $this->opt = $opt;
        $this->op1 = $op1;
        $this->op2 = $op2;
    }

    // calculate result by calling same name method
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

    // todo: fix '-INF' bug
    public function divide () {
        $op2 = (string)$this->op2;
        
        if ($op2 == '' || $op2 == '0') {
            $result = self::INFINITE_VALUE;
        } else if ($op2 == self::INFINITE_VALUE) {
            if ($this->op1 == self::INFINITE_VALUE)
                $result = self::INFINITE_VALUE;
            else
                $result = 0;
        } else {
            $result = $this->op1 / $this->op2;
        }

        return $result;
    }

}

?>
