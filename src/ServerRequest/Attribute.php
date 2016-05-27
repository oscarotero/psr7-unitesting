<?php

namespace Psr7Unitesting\ServerRequest;

use Psr\Http\Message\ServerRequestInterface;
use Psr7Unitesting\Utils\KeyValueConstraintTrait;

class Attribute extends AbstractConstraint
{
    use KeyValueConstraintTrait;

    public function toString()
    {
        return sprintf('has the attribute "%s" equals to "%s"', $this->key, $this->expected);
    }

    protected function runMatches(ServerRequestInterface $request)
    {
        $attributes = $request->getAttributes();

        return isset($attributes[$this->key]) && ($attributes[$this->key] == $this->expected);
    }

    protected function additionalFailureDescription($request)
    {
        $attributes = $request->getAttributes();

        if (!isset($attributes[$this->key])) {
            return sprintf('No attribute "%s" found', $this->key);
        }

        return sprintf('"%s" returned', $attributes[$this->key]);
    }
}
