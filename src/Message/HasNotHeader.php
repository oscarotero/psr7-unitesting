<?php

namespace Psr7Unitesting\Message;

use Psr\Http\Message\MessageInterface;
use Psr7Unitesting\Utils\ValueConstraintTrait;

class HasNotHeader extends AbstractConstraint
{
    use ValueConstraintTrait;

    public function toString()
    {
        return sprintf('has not the header "%s"', $this->expected);
    }

    protected function runMatches(MessageInterface $message)
    {
        return $message->hasHeader($this->expected) === false;
    }
}
