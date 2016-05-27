<?php

namespace Psr7Unitesting\Request;

use Psr\Http\Message\RequestInterface;
use Psr7Unitesting\Utils\ValueConstraintTrait;

class Method extends AbstractConstraint
{
    use ValueConstraintTrait;

    public function toString()
    {
        return sprintf('has the method "%s"', $this->expected);
    }

    protected function runMatches(RequestInterface $request)
    {
        return $request->getMethod() == $this->expected;
    }

    protected function additionalFailureDescription($request)
    {
        return sprintf('"%s" returned', $request->getMethod());
    }
}
