<?php
// src/Acme/CalculatorBundle//Tests/Calculators/BasicCalculatorTest.php
namespace Acme\CalculatorBundle\Tests\Calculators;
use Acme\CalculatorBundle\Calculators\BasicCalculator;

class BasicCalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $calc = new BasicCalculator("add", 1, 2);
        // assert that your calculator added the numbers correctly!
        $this->assertEquals(3, $calc->execute());
    }
}
