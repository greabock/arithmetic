<?php

namespace Greabock\Arithmetics;

class PrimitiveExpression extends AbstractExpression
{
    protected $string;
    /**
     * @var ExpressionContainer
     */
    private $container;

    public function __construct($string, ExpressionContainer $container)
    {
        $this->string = $string;
        $this->container = $container;
    }

    public function calculate(): float
    {
        if (preg_match('/#[0-9a-f]{32}#/', $this->string)) {
            return $this->container->get($this->string)->result();
        }

        return (float)$this->string;
    }
}