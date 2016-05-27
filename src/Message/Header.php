<?php

namespace Psr7Unitesting\Message;

use Psr\Http\Message\MessageInterface;
use Psr7Unitesting\Utils\KeyValueConstraintTrait;

class Header extends AbstractConstraint
{
    use KeyValueConstraintTrait;

    public function toString()
    {
        return sprintf('has the header "%s: %s"', $this->key, $this->expected);
    }

    protected function runMatches(MessageInterface $message)
    {
        return $this->expected == $message->getHeaderLine($this->key);
    }

    protected function additionalFailureDescription($message)
    {
        if (!$message->hasHeader()) {
            return 'No header found';
        }

        return sprintf('"%s: %s" returned', $this->expected, $message->getHeaderLine($this->key));
    }
}
