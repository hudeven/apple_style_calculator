<?php
// src/Acme/CalculatorBundle//Tests/Calculators/BasicCalculatorTest.php
namespace Acme\CalculatorBundle\Tests\Calculators;
use Acme\CalculatorBundle\Calculators\BasicCalculator;

class BasicCalculatorTest extends \PHPUnit_Framework_TestCase
{
	public function testEmpty()
    {
    	// first para has to be 'add', 'subtract' ...
    	// due to specific route 
        $cal = new BasicCalculator('add', '', '');
        $this->assertEquals(0, $cal->execute());

        $cal = new BasicCalculator('subtract', '', '');
        $this->assertEquals(0, $cal->execute());

        $cal = new BasicCalculator('multiply', '', '');
        $this->assertEquals(0, $cal->execute());

        $cal = new BasicCalculator('divide', '', '');
        $this->assertEquals(BasicCalculator::INFINITE_VALUE, $cal->execute());
    }
	
	/**
     * @depends testEmpty
     */
	public function testZero()
    {
        $cal = new BasicCalculator('add', 0, 0);
        $this->assertEquals(0, $cal->execute());

        $cal = new BasicCalculator('subtract', 0, 0);
        $this->assertEquals(0, $cal->execute());

        $cal = new BasicCalculator('multiply', 0, 0);
        $this->assertEquals(0, $cal->execute());

        $cal = new BasicCalculator('divide', 0, 0);
        $this->assertEquals(BasicCalculator::INFINITE_VALUE, $cal->execute());
    }

    /**
     * @depends testZero
     */
	public function testMixedZero()
    {
        $cal = new BasicCalculator('add', '0', 0);
        $this->assertEquals(0, $cal->execute());

        $cal = new BasicCalculator('subtract', 0, '-0');
        $this->assertEquals(0, $cal->execute());

        $cal = new BasicCalculator('multiply', '0', '0');
        $this->assertEquals(0, $cal->execute());

        $cal = new BasicCalculator('divide', '-0', '0');
        $this->assertEquals(BasicCalculator::INFINITE_VALUE, $cal->execute());

        $cal = new BasicCalculator('divide', '0', -0);
        $this->assertEquals(BasicCalculator::INFINITE_VALUE, $cal->execute());
    }

	/**
     * @depends testMixedZero
     */
    public function testExp()
    {
        $cal = new BasicCalculator('add', '1.5e2', 18);
        $this->assertEquals(168, $cal->execute());

         $cal = new BasicCalculator('add', 18, '1.5e2');
        $this->assertEquals(168, $cal->execute());

        $cal = new BasicCalculator('subtract', '45e3', '41e3');
        $this->assertEquals('4e3', $cal->execute());

        $cal = new BasicCalculator('multiply', '-82e14.44', 0);
        $this->assertEquals(0, $cal->execute());

        $cal = new BasicCalculator('multiply', '123e13', '-8.71e23');
        $this->assertEquals('-1.07133E39', $cal->execute());

        $cal = new BasicCalculator('divide', '1234', '4.32e12');
        $this->assertEquals('0.000000000285648', $cal->execute());
    }

	/**
     * @depends testMixedZero
     * @depends testExp
     */
	public function testINF()
    {
        $cal = new BasicCalculator('add', 'INF', 0);
        $this->assertEquals(0, $cal->execute());

        $cal = new BasicCalculator('subtract', 0, 'INF');
        $this->assertEquals(0, $cal->execute());

        $cal = new BasicCalculator('subtract', 'INF', 'INF');
        $this->assertEquals(0, $cal->execute());

        $cal = new BasicCalculator('multiply', 'INF', 'INF');
        $this->assertEquals(0, $cal->execute());

        $cal = new BasicCalculator('multiply', 'INF', 0);
        $this->assertEquals(0, $cal->execute());

        $cal = new BasicCalculator('divide', 'INF', '0');
        $this->assertEquals(BasicCalculator::INFINITE_VALUE, $cal->execute());

        $cal = new BasicCalculator('divide', '0', 'INF');
        $this->assertEquals(0, $cal->execute());

        $cal = new BasicCalculator('divide', 'INF', 'INF');
        $this->assertEquals(BasicCalculator::INFINITE_VALUE, $cal->execute());
    }


	/**
     * @depends testINF
     */
 	public function testOverflow()
    {
        $cal = new BasicCalculator('add', '987.6e1024', '1245.5433e2312');
        $this->assertEquals(BasicCalculator::INFINITE_VALUE, $cal->execute());

        // to fix it!!!  '-INF' didn't considered!!!
        $cal = new BasicCalculator('subtract', '45e3', '41e32112');
        $this->assertEquals('-INF', $cal->execute());

        $cal = new BasicCalculator('multiply', '82e1444', 78);
        $this->assertEquals(BasicCalculator::INFINITE_VALUE, $cal->execute());

        $cal = new BasicCalculator('divide', '1234', '4.32e112');
        $this->assertEquals(0, $cal->execute());
    }

	/**
     * @depends testOverflow
     */
	public function testNonNumber()
    {
        $cal = new BasicCalculator('add', '87.92.22', '231.83');
        $this->assertEquals('319.75', $cal->execute());

        // to fix it!!!  '-INF' didn't considered!!!
        $cal = new BasicCalculator('subtract', '45ea3', 'abc');
        $this->assertEquals('45', $cal->execute());

        $cal = new BasicCalculator('multiply', '82.sd1444', 'ersd');
        $this->assertEquals(0, $cal->execute());

        $cal = new BasicCalculator('divide', '.123.4', '4.32e.2');
        $this->assertEquals('0.028472222222222218', $cal->execute());
    }

	
    public function testGeneral()
    {
       $cal = new BasicCalculator('add', '46', 983);
        $this->assertEquals(1029, $cal->execute());

        $cal = new BasicCalculator('subtract', 82732234, '8272');
        $this->assertEquals('82723962', $cal->execute());

        $cal = new BasicCalculator('subtract', 387232, 9282722);
        $this->assertEquals(-8895490, $cal->execute());

        $cal = new BasicCalculator('multiply', 82722123, 1);
        $this->assertEquals(82722123, $cal->execute());

        $cal = new BasicCalculator('multiply', 383, 12);
        $this->assertEquals(4596, $cal->execute());

        $cal = new BasicCalculator('divide', 9283, 121224);
        $this->assertEquals('0.07657724543', $cal->execute());

        $cal = new BasicCalculator('divide', 12, 3.0);
        $this->assertEquals('4.0', $cal->execute());

        $cal = new BasicCalculator('divide', '904084', 92);
        $this->assertEquals(9827, $cal->execute());
    }
}
