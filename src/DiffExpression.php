<?php

namespace Greabock\Arithmetics;

class DiffExpression extends AbstractExpression
{
    /**
     * @var ExpressionInterface
     */
    protected $left;
    /**
     * @var ExpressionInterface
     */
    protected $right;

    /**
     * @var float
     */
    protected $result;

    public function __construct(ExpressionInterface $left, ExpressionInterface $right)
    {
        $this->left = $left;
        $this->right = $right;
    }

    public function calculate(): float
    {
        return $this->left->result() - $this->right->result();
    }
}