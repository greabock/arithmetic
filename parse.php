<?php

use Greabock\Arithmetics\ExpressionContainer;
use Greabock\Arithmetics\Node;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

function main()
{
    $expression = readline('Enter an expression: ');

    if ($expression === 'exit') {
        return;
    }

    echo Node::parse(new ExpressionContainer(), $expression)->result() . PHP_EOL;

    main();
}

main();