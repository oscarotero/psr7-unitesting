<?php

namespace Psr7Unitesting\Uri;

use Psr7Unitesting\Utils\AbstractConstraint as Constraint;
use Psr\Http\Message\UriInterface;

abstract class AbstractConstraint extends Constraint
{
    protected function matches($uri)
    {
        return $this->runMatches($uri);
    }

    abstract protected function runMatches(UriInterface $uri);
}
