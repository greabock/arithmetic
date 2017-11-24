<?php

namespace Greabock\Arithmetics;

use DivisionByZeroError;

class DivisionExpression extends AbstractExpression
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

    /**
     * DivisionExpression constructor.
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
        if (!$this->right->result()) {
            throw new DivisionByZeroError('Oops');
        }

        return $this->left->result() / $this->right->result();
    }
}