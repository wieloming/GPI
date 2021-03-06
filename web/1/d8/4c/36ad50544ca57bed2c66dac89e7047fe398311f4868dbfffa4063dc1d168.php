<?php

/* SonataPageBundle:Block:block_base.html.twig */
class __TwigTemplate_d84c36ad50544ca57bed2c66dac89e7047fe398311f4868dbfffa4063dc1d168 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'block_class' => array($this, 'block_block_class'),
            'block_role' => array($this, 'block_block_role'),
            'block' => array($this, 'block_block'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 11
        echo "
";
        // line 12
        if ($this->getAttribute((isset($context["sonata_page"]) ? $context["sonata_page"] : $this->getContext($context, "sonata_page")), "isInlineEditionOn", array())) {
            // line 13
            echo "    <div id=\"cms-block-";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["block"]) ? $context["block"] : $this->getContext($context, "block")), "id", array()), "html", null, true);
            echo "\"
         class=\"cms-block";
            // line 14
            if ($this->getAttribute((isset($context["block"]) ? $context["block"] : $this->getContext($context, "block")), "hasParent", array(), "method")) {
                echo " cms-block-element";
            }
            $this->displayBlock('block_class', $context, $blocks);
            echo "\"
        ";
            // line 15
            if (($this->getAttribute((isset($context["sonata_page"]) ? $context["sonata_page"] : $this->getContext($context, "sonata_page")), "isEditor", array()) && $this->getAttribute((isset($context["block"]) ? $context["block"] : null), "page", array(), "any", true, true))) {
                // line 16
                echo "            data-id=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["block"]) ? $context["block"] : $this->getContext($context, "block")), "id", array()), "html", null, true);
                echo "\"
            data-name=\"";
                // line 17
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["block"]) ? $context["block"] : $this->getContext($context, "block")), "name", array()), "html", null, true);
                echo "\"
            data-role=\"";
                // line 18
                $this->displayBlock('block_role', $context, $blocks);
                echo "\"
            data-page-id=\"";
                // line 19
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["block"]) ? $context["block"] : $this->getContext($context, "block")), "page", array()), "id", array()), "html", null, true);
                echo "\"
        ";
            }
            // line 21
            echo "        >
";
        } elseif ($this->getAttribute((isset($context["sonata_page"]) ? $context["sonata_page"] : $this->getContext($context, "sonata_page")), "isEditor", array(), "method")) {
            // line 23
            echo "    <!-- start rendering, block.id: ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["block"]) ? $context["block"] : $this->getContext($context, "block")), "id", array()), "html", null, true);
            echo " - page.id: ";
            if ($this->getAttribute((isset($context["block"]) ? $context["block"] : null), "page", array(), "any", true, true)) {
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["block"]) ? $context["block"] : $this->getContext($context, "block")), "page", array()), "id", array()), "html", null, true);
            } else {
                echo "no related page";
            }
            echo " - name: ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["block"]) ? $context["block"] : $this->getContext($context, "block")), "name", array()), "html", null, true);
            echo " -->
";
        }
        // line 25
        echo "
";
        // line 26
        $this->displayBlock('block', $context, $blocks);
        // line 27
        echo "
";
        // line 28
        if ($this->getAttribute((isset($context["sonata_page"]) ? $context["sonata_page"] : $this->getContext($context, "sonata_page")), "isInlineEditionOn", array())) {
            // line 29
            echo "    </div>
";
        } elseif ($this->getAttribute((isset($context["sonata_page"]) ? $context["sonata_page"] : $this->getContext($context, "sonata_page")), "isEditor", array(), "method")) {
            // line 31
            echo "    <!-- end rendering, block.id: ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["block"]) ? $context["block"] : $this->getContext($context, "block")), "id", array()), "html", null, true);
            echo " - page.id: ";
            if ($this->getAttribute((isset($context["block"]) ? $context["block"] : null), "page", array(), "any", true, true)) {
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["block"]) ? $context["block"] : $this->getContext($context, "block")), "page", array()), "id", array()), "html", null, true);
            } else {
                echo "no related page";
            }
            echo "  - name: ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["block"]) ? $context["block"] : $this->getContext($context, "block")), "name", array()), "html", null, true);
            echo " -->
";
        }
    }

    // line 14
    public function block_block_class($context, array $blocks = array())
    {
    }

    // line 18
    public function block_block_role($context, array $blocks = array())
    {
        echo "block";
    }

    // line 26
    public function block_block($context, array $blocks = array())
    {
        echo "EMPTY CONTENT";
    }

    public function getTemplateName()
    {
        return "SonataPageBundle:Block:block_base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  118 => 26,  112 => 18,  107 => 14,  91 => 31,  87 => 29,  85 => 28,  82 => 27,  80 => 26,  77 => 25,  63 => 23,  59 => 21,  54 => 19,  50 => 18,  46 => 17,  41 => 16,  39 => 15,  32 => 14,  27 => 13,  25 => 12,  22 => 11,);
    }
}
