<?php

/* GPISiteBundle:Default:faq.html.twig */
class __TwigTemplate_4578a7251754db7514d24a40eb0920f14ae2e56ab7c7585ce4badc282bf453b0 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        echo "<div class=\"headline\"><h2>";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["site"]) ? $context["site"] : $this->getContext($context, "site")), "name", array()), "html", null, true);
        echo "</h2></div>
";
        // line 2
        echo $this->getAttribute((isset($context["site"]) ? $context["site"] : $this->getContext($context, "site")), "content", array());
    }

    public function getTemplateName()
    {
        return "GPISiteBundle:Default:faq.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  24 => 2,  19 => 1,);
    }
}
