<?php

namespace Psr7Unitesting\ServerRequest;

use Psr\Http\Message\ServerRequestInterface;
use Psr7Unitesting\Utils\KeyValueConstraintTrait;

class CookieParam extends AbstractConstraint
{
    use KeyValueConstraintTrait;

    public function toString()
    {
        return sprintf('has the cookie parameter "%s" equals to "%s"', $this->key, $this->expected);
    }

    protected function runMatches(ServerRequestInterface $request)
    {
        $cookies = $request->getCookieParams();

        return isset($cookies[$this->key]) && ($cookies[$this->key] == $this->expected);
    }

    protected function additionalFailureDescription($request)
    {
        $cookies = $request->getCookieParams();

        if (!isset($cookies[$this->key])) {
            return sprintf('No cookie parameter "%s" found', $this->key);
        }

        return sprintf('"%s" returned', $cookies[$this->key]);
    }
}
