<?php

namespace Psr7Unitesting\ServerRequest;

use Psr\Http\Message\ServerRequestInterface;
use Psr7Unitesting\Utils\KeyValueConstraintTrait;

class ParsedBody extends AbstractConstraint
{
    use KeyValueConstraintTrait;

    public function toString()
    {
        return sprintf('has the value "%s" equals to "%s" in the parsed body', $this->key, $this->expected);
    }

    protected function runMatches(ServerRequestInterface $request)
    {
        $body = $request->getParsedBody();

        return isset($body[$this->key]) && ($body[$this->key] == $this->expected);
    }

    protected function additionalFailureDescription($request)
    {
        $body = $request->getParsedBody();

        if (!isset($body[$this->key])) {
            return sprintf('No value "%s" found', $this->key);
        }

        return sprintf('"%s" returned', $body[$this->key]);
    }
}
