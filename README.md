Apple Style Calculator

It's a test project for Quicken Loans interview.

Front end:  

            imitate apple's calculator UI by Bootstrap
            imitate apple's calculator logic by a State Machine, see @AcmeCalculatorBundle/docs/calculator_state_machine.jpg
            call remote server API to calculate result

Back end:   

            provide a set of calculation APIs based on Symfony framework (i.e  /add/123/456)
            implement a BasicCalculator class to deal with calculation logic independently
            Use Symfony Validation to valid operation and operands
            Create unite tests for BasicCalculator
            Create functional tests for CalculatorController
            Build a new bundle AcmeCalculatorBundle for above. 
            Deploy app on AWS: http://calculator.hudeven.com

Bugs:       

            500 server internal error when using supper large operands
            No effect on buttons when using keyboard
            

==========

A Symfony project created on May 28, 2015, 5:28 pm.
