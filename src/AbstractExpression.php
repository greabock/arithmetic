<?php

namespace Greabock\Arithmetics;

abstract class AbstractExpression implements ExpressionInterface
{
    protected $result;

    public function result(): float
    {
        if($this->result) {
            return $this->result;
        }

        return $this->result = $this->calculate();
    }

    abstract function calculate(): float;
}