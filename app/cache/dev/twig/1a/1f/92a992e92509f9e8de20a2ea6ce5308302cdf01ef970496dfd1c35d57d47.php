<?php

/* :default:hello.xml.twig */
class __TwigTemplate_1a1f92a992e92509f9e8de20a2ea6ce5308302cdf01ef970496dfd1c35d57d47 extends Twig_Template
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
        // line 1
        echo "<!-- app/Resources/views/default/hello.xml.twig -->
<hello>
    <name>";
        // line 3
        echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")), "html", null, true);
        echo "</name>
</hello>
";
    }

    public function getTemplateName()
    {
        return ":default:hello.xml.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  23 => 3,  19 => 1,);
    }
}
