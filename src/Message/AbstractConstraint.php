<?php

namespace Psr7Unitesting\Message;

use Psr7Unitesting\Utils\AbstractConstraint as Constraint;
use Psr\Http\Message\MessageInterface;

abstract class AbstractConstraint extends Constraint
{
    protected function matches($message)
    {
        return $this->runMatches($message);
    }

    abstract protected function runMatches(MessageInterface $message);
}
