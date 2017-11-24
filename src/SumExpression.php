<?php

namespace Greabock\Arithmetics;

class SumExpression extends AbstractExpression
{
    /**
     * @var float
     */
    protected $result;
    /**
     * @var ExpressionInterface
     */
    private $left;
    /**
     * @var ExpressionInterface
     */
    private $right;

    /**
     * SumExpression constructor.
     * @param ExpressionInterface $left
     * @param ExpressionInterface $right
     */
    public function __construct(ExpressionInterface $left, ExpressionInterface $right)
    {
        $this->left = $left;
        $this->right = $right;
    }

    public function calculate(): float
    {
        return $this->result = $this->left->result() + $this->right->result();
    }
}