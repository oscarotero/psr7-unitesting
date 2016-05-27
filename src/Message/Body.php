<?php

namespace Psr7Unitesting\Message;

use Psr\Http\Message\MessageInterface;
use Psr7Unitesting\Utils\ValueConstraintTrait;

class Body extends AbstractConstraint
{
    use ValueConstraintTrait;

    public function toString()
    {
        return sprintf('has the body with the content "%s"', $this->expected);
    }

    protected function runMatches(MessageInterface $message)
    {
        return (string) $message->getBody() == $this->expected;
    }

    protected function additionalFailureDescription($message)
    {
        return sprintf('"%s" returned', (string) $message->getBody());
    }
}
