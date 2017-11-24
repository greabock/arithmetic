<?php

namespace Greabock\Arithmetics;

class ExpressionContainer
{
    protected $expressions = [];

    public function set($key, $expression)
    {
        $this->expressions[$key] = $expression;
    }

    public function get($key)
    {
        return $this->expressions[$key];
    }
}