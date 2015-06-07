<?php

/* AcmeCalculatorBundle:Calculator:calculate.html.twig */
class __TwigTemplate_a4ef6bdf8393ff2c54c5013338fce5f3625f064f34aeeaa3b1fca9388aa8093f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo twig_escape_filter($this->env, (isset($context["result"]) ? $context["result"] : $this->getContext($context, "result")), "html", null, true);
        echo "
";
    }

    public function getTemplateName()
    {
        return "AcmeCalculatorBundle:Calculator:calculate.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  19 => 2,);
    }
}
