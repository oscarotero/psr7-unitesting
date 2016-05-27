<?php

namespace Psr7Unitesting\Uri;

use Psr\Http\Message\UriInterface;
use Psr7Unitesting\Utils\ValueConstraintTrait;

class Host extends AbstractConstraint
{
    use ValueConstraintTrait;

    public function toString()
    {
        return sprintf('has the host "%s"', $this->expected);
    }

    protected function runMatches(UriInterface $uri)
    {
        return $uri->getHost() == $this->expected;
    }

    protected function additionalFailureDescription($uri)
    {
        return sprintf('"%s" returned', $uri->getHost());
    }
}
