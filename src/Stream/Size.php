<?php

namespace Psr7Unitesting\Stream;

use Psr\Http\Message\StreamInterface;
use Psr7Unitesting\Utils\ValueConstraintTrait;

class Size extends AbstractConstraint
{
    use ValueConstraintTrait;

    public function toString()
    {
        return sprintf('has the size "%s"', $this->expected);
    }

    protected function runMatches(StreamInterface $stream)
    {
        return $stream->getSize() == $this->expected;
    }

    protected function additionalFailureDescription($stream)
    {
        return sprintf('"%s" returned', $stream->getSize());
    }
}
