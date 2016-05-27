<?php

namespace Psr7Unitesting\ServerRequest;

use Psr\Http\Message\ServerRequestInterface;
use Psr7Unitesting\Utils\ValueConstraintTrait;

class HasAttribute extends AbstractConstraint
{
    use ValueConstraintTrait;

    public function toString()
    {
        return sprintf('has the attribute "%s"', $this->expected);
    }

    protected function runMatches(ServerRequestInterface $request)
    {
        $attributes = $request->getAttributes();

        return isset($attributes[$this->expected]);
    }
}
