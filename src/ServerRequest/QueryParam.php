<?php

namespace Psr7Unitesting\ServerRequest;

use Psr\Http\Message\ServerRequestInterface;
use Psr7Unitesting\Utils\KeyValueConstraintTrait;

class QueryParam extends AbstractConstraint
{
    use KeyValueConstraintTrait;

    public function toString()
    {
        return sprintf('has the query parameter "%s" equals to "%s"', $this->key, $this->expected);
    }

    protected function runMatches(ServerRequestInterface $request)
    {
        $query = $request->getQueryParams();

        return isset($query[$this->key]) && ($query[$this->key] == $this->expected);
    }

    protected function additionalFailureDescription($request)
    {
        $query = $request->getQueryParams();

        if (!isset($query[$this->key])) {
            return sprintf('No query parameter "%s" found', $this->key);
        }

        return sprintf('"%s" returned', $query[$this->key]);
    }
}
