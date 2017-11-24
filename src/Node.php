<?php

namespace Greabock\Arithmetics;

class Node implements ExpressionInterface
{
    const OPERATOR_SUM = '+';
    const OPERATOR_DIFF = '-';
    const OPERATOR_MULTIPLICATION = '*';
    const OPERATOR_DIVISION = '/';

    protected $string;

    /**
     * @var ExpressionInterface
     */
    protected $expression;

    /**
     * @var ExpressionContainer
     */
    protected $container;

    /**
     * Node constructor.
     * @param $string
     * @param ExpressionContainer $container
     */
    public function __construct($string, ExpressionContainer $container)
    {
        $this->string = trim($string);
        $this->container = $container;
        $this->replaceSubExpressions();

        switch (true) {
            case $this->parseSum():
                break;
            case $this->parseDiff():
                break;
            case $this->parseMulti():
                break;
            case $this->parseDivision():
                break;
            default:
                $this->primitive();
        }
    }

    public static function parse(ExpressionContainer $container, $expression)
    {
        return new static($expression, $container);
    }

    protected function parseSum(): bool
    {
        if (strpos($this->string, static::OPERATOR_SUM)) {
            $result = explode(static::OPERATOR_SUM, $this->string, 2);
            $this->expression = new SumExpression(static::parse($this->container, $result[0]), static::parse($this->container, $result[1]));
            return true;
        }

        return false;
    }

    protected function parseDiff(): bool
    {
        $str = strrev($this->string);
        $pattern = '#-(?![*/])#';
        if (preg_match($pattern, $str)) {
            $result  = preg_split($pattern, $str, 2);
            $this->expression = new DiffExpression(static::parse($this->container, strrev($result[1])), static::parse($this->container, strrev($result[0])));
            return true;
        }

        return false;
    }

    protected function parseMulti(): bool
    {
        if (strpos($this->string, static::OPERATOR_MULTIPLICATION)) {
            $result = explode(static::OPERATOR_MULTIPLICATION, $this->string);
            $this->expression = new MultiExpression(static::parse($this->container, $result[0]), static::parse($this->container, $result[1]));
            return true;
        }

        return false;
    }

    protected function parseDivision($s = 2): bool
    {
        $str = strrev($this->string);

        if (strpos($str, static::OPERATOR_DIVISION)) {
            $result = explode(static::OPERATOR_DIVISION, $str, 2);
            $this->expression = new DivisionExpression(static::parse($this->container, strrev($result[1])), static::parse($this->container, strrev($result[0])));
            return true;
        }

        return false;
    }

    public function result(): float
    {
        return $this->expression->result();
    }

    protected function primitive()
    {
        $this->expression = new PrimitiveExpression($this->string, $this->container);
    }

    private function replaceSubExpressions()
    {
        if(preg_match("/\((?'expression'.*)\)/", $this->string, $matches)){
            $expression = static::parse($this->container, $matches['expression']);
            $hash = '#'.spl_object_hash($expression).'#';
            $this->container->set($hash, $expression);
            $this->string = preg_replace("/\((?'expression'.*)\)/", $hash, $this->string);
        }
    }
}