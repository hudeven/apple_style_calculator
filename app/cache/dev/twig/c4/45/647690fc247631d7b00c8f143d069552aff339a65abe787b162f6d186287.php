<?php

/* AcmeCalculatorBundle:Calculator:index.html.twig */
class __TwigTemplate_c445647690fc247631d7b00c8f143d069552aff339a65abe787b162f6d186287 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
  <head>
    <title>Steven - Calculator</title>
    <link rel=\"stylesheet\" href=\"http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css\">
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js\"></script>


";
        // line 9
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 12
        echo "
";
        // line 13
        $this->displayBlock('javascripts', $context, $blocks);
        // line 16
        echo "
  </head>
  <body>

    <div class=\"navbar navbar-inverse\">
      <div class=\"navbar-header\">
      <a class=\"navbar-brand\" href=\"#\">Apple Style Calculator</a>
    </div>
    </div>

    <div class=\"container col-md-6 col-md-offset-3\">
      <div class=\"row\">
            <div id=\"cal-error\"></div>
      </div>

      <div class=\"row\">
            <input type=\"text\" id=\"cal-display\">
      </div>

      <div class=\"row\" id=\"cal-panel\">
          
            <div class=\"btn-group btn-group-justified\">
              <a href=\"#\" class=\"btn-clear btn btn-default span1\" id=\"btn-clear\" data-type=\"clr\" data-value=\"c\">C</a>

              <a href=\"#\" class=\"btn-general btn btn-default\" data-type=\"rev\" data-value=\"r\">&plusmn;</a>

              <a href=\"#\" class=\"btn-general btn btn-default\" data-type=\"per\" data-value=\"%\">%</a>

              <a href=\"#\" class=\"btn-general btn btn-warning\" data-type=\"opt\" data-value=\"/\">&divide;</a>
            </div>
          
            <div class=\"btn-group btn-group-justified\">
              <a href=\"#\" class=\"btn-general btn btn-default col-dm-1\" data-type=\"dig\" data-value=\"7\">7</a>
              <a href=\"#\" class=\"btn-general btn btn-default\" data-type=\"dig\" data-value=\"8\">8</a>
              <a href=\"#\" class=\"btn-general btn btn-default\" data-type=\"dig\" data-value=\"9\">9</a>
              <a href=\"#\" class=\"btn-general btn btn-warning\" data-type=\"opt\" data-value=\"*\">&times;</a>
            </div>
          
            <div class=\"btn-group btn-group-justified\">
              <a href=\"#\" class=\"btn-general btn btn-default\" data-type=\"dig\" data-value=\"4\">4</a>
              <a href=\"#\" class=\"btn-general btn btn-default\" data-type=\"dig\" data-value=\"5\">5</a>
              <a href=\"#\" class=\"btn-general btn btn-default\" data-type=\"dig\" data-value=\"6\">6</a>
              <a href=\"#\" class=\"btn-general btn btn-warning\" data-type=\"opt\" data-value=\"-\">&#8722;</a>
            </div>
          
            <div class=\"btn-group btn-group-justified\">
              <a href=\"#\" class=\"btn-general btn btn-default\" data-type=\"dig\" data-value=\"1\">1</a>
              <a href=\"#\" class=\"btn-general btn btn-default\" data-type=\"dig\" data-value=\"2\">2</a>
              <a href=\"#\" class=\"btn-general btn btn-default\" data-type=\"dig\" data-value=\"3\">3</a>
              <a href=\"#\" class=\"btn-general btn btn-warning\" data-type=\"opt\" data-value=\"+\">+</a>
            </div>
          
            <div class=\"left-half btn-group btn-group-justified\">
              <a href=\"#\" class=\" btn-general btn btn-default\" data-type=\"dig\" data-value=\"0\" id=\"btn-zero\">0</a>
            </div>
          

            <div class=\"right-half btn-group btn-group-justified\">
              <a href=\"#\" class=\" btn-general btn btn-default\" data-type=\"dot\" data-value=\".\">.</a>
              <a href=\"#\" class=\" btn-general btn btn-warning\" data-type=\"equ\" data-value=\"=\" >=</a>
            </div>
      </div>
    </div>

<footer>
  <p>Posted by: Hege Refsnes</p>
  <p>Contact information: <a href=\"mailto:someone@example.com\">
  someone@example.com</a>.</p>
</footer>

  </body>
</html>
";
    }

    // line 9
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 10
        echo "            <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/my_cal.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" />
";
    }

    // line 13
    public function block_javascripts($context, array $blocks = array())
    {
        // line 14
        echo "            <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/my_cal.js"), "html", null, true);
        echo "\"></script>
";
    }

    public function getTemplateName()
    {
        return "AcmeCalculatorBundle:Calculator:index.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  127 => 14,  124 => 13,  117 => 10,  114 => 9,  38 => 16,  36 => 13,  33 => 12,  31 => 9,  21 => 1,);
    }
}
