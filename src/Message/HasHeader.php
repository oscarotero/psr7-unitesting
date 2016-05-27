<?php

namespace Psr7Unitesting\Message;

use Psr\Http\Message\MessageInterface;
use Psr7Unitesting\Utils\ValueConstraintTrait;

class HasHeader extends AbstractConstraint
{
    use ValueConstraintTrait;

    public function toString()
    {
        return sprintf('has the header "%s"', $this->expected);
    }

    protected function runMatches(MessageInterface $message)
    {
        return $message->hasHeader($this->expected);
    }
}
