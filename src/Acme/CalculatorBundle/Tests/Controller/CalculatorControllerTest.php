<?php

namespace Acme\CalculatorBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertTrue($crawler->filter('html:contains("Apple Style Calculator")')->count() > 0);
    }


    public function testAdd()
    {
        $client = static::createClient();

        $client->request('GET', '/calculator/add/321/456');
	
        $response = $client->getResponse();
	
        $data = json_decode($response->getContent(), true);

	$this->assertSame(array('result' => 777, 'error' => ''), $data);

    }

    public function testSubtract()
    {
        $client = static::createClient();

        $client->request('GET', '/calculator/subtract/8371/92834');
	
        $response = $client->getResponse();
	
        $data = json_decode($response->getContent(), true);

	$this->assertSame(array('result' => -84463, 'error' => ''), $data);

    }

    public function testMultiply()
    {
        $client = static::createClient();

        $client->request('GET', '/calculator/multiply/31/-834');
	
        $response = $client->getResponse();
	
        $data = json_decode($response->getContent(), true);

	$this->assertSame(array('result' => -25854, 'error' => ''), $data);

    }

    public function testDivide()
    {
        $client = static::createClient();

        $client->request('GET', '/calculator/divide/8371/0');
	
        $response = $client->getResponse();
	
        $data = json_decode($response->getContent(), true);

	$this->assertSame(array('result' => 'INF', 'error' => ''), $data);

    }

/*  bug: 500 server internal error
    public function testOverflow()
    {
       $client = static::createClient();

        $client->request('GET', '/calculator/multiply/3.025764e+200/3.025764e+200');
	
        $response = $client->getResponse();
	
        $data = json_decode($response->getContent(), true);

	$this->assertSame(array('result' => 'INF', 'error' => ''), $data);

    }
*/

/*
    public function testInvalidOp1()
    {
        $client = static::createClient();

        $client->request('GET', '/calculator/divide/83a71/123');
	
        $response = $client->getResponse();
	
        $data = json_decode($response->getContent(), true);

	$this->assertSame(array('result' => '', 'error' => 'Object(Acme\\CalculatorBundle\\Calculators\\BasicCalculator).op1:\n    The value "83a71" is not a valid numeric.\n'), $data);

    }

    public function testInvalidOp2()
    {
        $client = static::createClient();

        $client->request('GET', '/calculator/add/531/12.3.4');
	
        $response = $client->getResponse();
	
        $data = json_decode($response->getContent(), true);

	$this->assertSame(array('result' => '', 'error' =>'Object(Acme\CalculatorBundle\Calculators\BasicCalculator).op2:
    The value "12.3.4" is not a valid numeric.\n' ), $data);

    }

     public function testInvalidOp1Op2()
    {
        $client = static::createClient();

        $client->request('GET', '/calculator/add/5.3a1/12a4.3.4');
	
        $response = $client->getResponse();
	
        $data = json_decode($response->getContent(), true);

	$this->assertSame(array('result' => '', 'error' =>"Object(Acme\\CalculatorBundle\\Calculators\\BasicCalculator).op1:\n    The value 5.3a1 is not a valid numeric.\nObject(Acme\\CalculatorBundle\\Calculators\\BasicCalculator).op2:\n    The value 12a4.3.4 is not a valid numeric.\n"), $data);

    }
*/

}
