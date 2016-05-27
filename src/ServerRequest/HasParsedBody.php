<?php

namespace Psr7Unitesting\ServerRequest;

use Psr\Http\Message\ServerRequestInterface;
use Psr7Unitesting\Utils\ValueConstraintTrait;

class HasParsedBody extends AbstractConstraint
{
    use ValueConstraintTrait;

    public function toString()
    {
        return sprintf('has the key "%s" in the parsed body', $this->expected);
    }

    protected function runMatches(ServerRequestInterface $request)
    {
        $body = $request->getParsedBody();

        return isset($body[$this->expected]);
    }
}
