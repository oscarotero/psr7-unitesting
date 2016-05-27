<?php

namespace Psr7Unitesting\ServerRequest;

use Psr7Unitesting\Utils\AbstractConstraint as Constraint;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractConstraint extends Constraint
{
    protected function matches($request)
    {
        return $this->runMatches($request);
    }

    abstract protected function runMatches(ServerRequestInterface $request);
}
