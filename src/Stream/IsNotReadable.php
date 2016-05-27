<?php

namespace Psr7Unitesting\Stream;

use Psr\Http\Message\StreamInterface;

class IsNotReadable extends AbstractConstraint
{
    public function toString()
    {
        return 'is not readable';
    }

    protected function runMatches(StreamInterface $stream)
    {
        return $stream->isReadable() === false;
    }
}
