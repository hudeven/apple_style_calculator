<?php

/* AcmeCalculatorBundle:Calculator:index.html.twig */
class __TwigTemplate_c445647690fc247631d7b00c8f143d069552aff339a65abe787b162f6d186287 extends Twig_Template
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
        return "AcmeCalculatorBundle:Calculator:index.html.twig";
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
