<?php

namespace Psr7Unitesting\ServerRequest;

use Psr\Http\Message\ServerRequestInterface;
use Psr7Unitesting\Utils\ValueConstraintTrait;

class HasServerParam extends AbstractConstraint
{
    use ValueConstraintTrait;

    public function toString()
    {
        return sprintf('has the server parameter "%s"', $this->expected);
    }

    protected function runMatches(ServerRequestInterface $request)
    {
        $server = $request->getServerParams();

        return isset($server[$this->expected]);
    }
}
