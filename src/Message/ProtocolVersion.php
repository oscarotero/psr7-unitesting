<?php

namespace Psr7Unitesting\Message;

use Psr\Http\Message\MessageInterface;
use Psr7Unitesting\Utils\ValueConstraintTrait;

class ProtocolVersion extends AbstractConstraint
{
    use ValueConstraintTrait;

    public function toString()
    {
        return sprintf('has the protocol version "%s"', $this->expected);
    }

    protected function runMatches(MessageInterface $message)
    {
        return $message->getProtocolVersion() == $this->expected;
    }

    protected function additionalFailureDescription($request)
    {
        return sprintf('"%s" returned', $request->getProtocolVersion());
    }
}
