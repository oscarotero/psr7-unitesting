<?php

namespace Psr7Unitesting\Response;

use Psr\Http\Message\ResponseInterface;
use Psr7Unitesting\Utils\ValueConstraintTrait;

class ReasonPhrase extends AbstractConstraint
{
    use ValueConstraintTrait;

    public function toString()
    {
        return sprintf('has the reason phrase "%s"', $this->expected);
    }

    protected function runMatches(ResponseInterface $response)
    {
        return $response->getReasonPhrase() == $this->expected;
    }

    protected function additionalFailureDescription($request)
    {
        return sprintf('"%s" returned', $request->getReasonPhrase());
    }
}
