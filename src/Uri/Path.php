<?php

namespace Psr7Unitesting\Uri;

use Psr\Http\Message\UriInterface;
use Psr7Unitesting\Utils\ValueConstraintTrait;

class Path extends AbstractConstraint
{
    use ValueConstraintTrait;

    public function toString()
    {
        return sprintf('has the path "%s"', $this->expected);
    }

    protected function runMatches(UriInterface $uri)
    {
        return $uri->getPath() == $this->expected;
    }

    protected function additionalFailureDescription($uri)
    {
        return sprintf('"%s" returned', $uri->getPath());
    }
}
