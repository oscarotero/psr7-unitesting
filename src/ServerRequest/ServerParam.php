<?php

namespace Psr7Unitesting\ServerRequest;

use Psr\Http\Message\ServerRequestInterface;
use Psr7Unitesting\Utils\KeyValueConstraintTrait;

class ServerParam extends AbstractConstraint
{
    use KeyValueConstraintTrait;

    public function toString()
    {
        return sprintf('has the server parameter "%s" equals to "%s"', $this->key, $this->expected);
    }

    protected function runMatches(ServerRequestInterface $request)
    {
        $server = $request->getServerParams();

        return isset($server[$this->key]) && ($server[$this->key] == $this->expected);
    }

    protected function additionalFailureDescription($request)
    {
        $server = $request->getAttributes();

        if (!isset($server[$this->key])) {
            return sprintf('No server parameter "%s" found', $this->key);
        }

        return sprintf('"%s" returned', $server[$this->key]);
    }
}
