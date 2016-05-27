<?php

namespace Psr7Unitesting\Request;

use Psr7Unitesting\Utils\AbstractConstraint as Constraint;
use Psr\Http\Message\RequestInterface;

abstract class AbstractConstraint extends Constraint
{
    protected function matches($request)
    {
        return $this->runMatches($request);
    }

    abstract protected function runMatches(RequestInterface $request);
}
