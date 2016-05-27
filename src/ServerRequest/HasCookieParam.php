<?php

namespace Psr7Unitesting\ServerRequest;

use Psr\Http\Message\ServerRequestInterface;
use Psr7Unitesting\Utils\ValueConstraintTrait;

class HasCookieParam extends AbstractConstraint
{
    use ValueConstraintTrait;

    public function toString()
    {
        return sprintf('has the cookies parameter "%s"', $this->expected);
    }

    protected function runMatches(ServerRequestInterface $request)
    {
        $cookies = $request->getCookieParams();

        return isset($cookies[$this->expected]);
    }
}
