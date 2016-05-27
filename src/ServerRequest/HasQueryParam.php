<?php

namespace Psr7Unitesting\ServerRequest;

use Psr\Http\Message\ServerRequestInterface;
use Psr7Unitesting\Utils\ValueConstraintTrait;

class HasQueryParam extends AbstractConstraint
{
    use ValueConstraintTrait;

    public function toString()
    {
        return sprintf('has the query parameter "%s"', $this->expected);
    }

    protected function runMatches(ServerRequestInterface $request)
    {
        $query = $request->getQueryParams();

        return isset($query[$this->expected]);
    }
}
