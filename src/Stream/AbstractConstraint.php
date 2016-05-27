<?php

namespace Psr7Unitesting\Stream;

use Psr7Unitesting\Utils\AbstractConstraint as Constraint;
use Psr\Http\Message\StreamInterface;

abstract class AbstractConstraint extends Constraint
{
    protected function matches($uri)
    {
        return $this->runMatches($uri);
    }

    abstract protected function runMatches(StreamInterface $uri);
}
