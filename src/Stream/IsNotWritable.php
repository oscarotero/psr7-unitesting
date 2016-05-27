<?php

namespace Psr7Unitesting\Stream;

use Psr\Http\Message\StreamInterface;

class IsNotWritable extends AbstractConstraint
{
    public function toString()
    {
        return 'is not writable';
    }

    protected function runMatches(StreamInterface $stream)
    {
        return $stream->isWritable() === false;
    }
}
