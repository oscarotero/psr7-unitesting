<?php

namespace Psr7Unitesting\Response;

use Psr\Http\Message\ResponseInterface;
use Psr7Unitesting\Utils\ValueConstraintTrait;

class StatusCode extends AbstractConstraint
{
    use ValueConstraintTrait;

    public function toString()
    {
        return sprintf('has the status code "%s"', $this->expected);
    }

    protected function runMatches(ResponseInterface $response)
    {
        return $response->getStatusCode() == $this->expected;
    }

    protected function additionalFailureDescription($request)
    {
        return sprintf('"%s" returned', $request->getStatusCode());
    }
}
