<?php

namespace Psr7Unitesting\Request;

use Psr\Http\Message\RequestInterface;
use Psr7Unitesting\Utils\ValueConstraintTrait;

class Uri extends AbstractConstraint
{
    use ValueConstraintTrait;

    public function toString()
    {
        return sprintf('has the uri "%s"', $this->expected);
    }

    protected function runMatches(RequestInterface $request)
    {
        return (string) $request->getUri() == $this->expected;
    }

    protected function additionalFailureDescription($request)
    {
        return sprintf('"%s" returned', (string) $request->getUri());
    }
}
