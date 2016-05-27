<?php

namespace Psr7Unitesting\Response;

use Psr7Unitesting\Utils\AbstractConstraint as Constraint;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractConstraint extends Constraint
{
    protected function matches($response)
    {
        return $this->runMatches($response);
    }

    abstract protected function runMatches(ResponseInterface $response);
}
