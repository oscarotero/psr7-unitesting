<?php

namespace Psr7Unitesting\Stream;

use Psr\Http\Message\StreamInterface;

class IsWritable extends AbstractConstraint
{
    public function toString()
    {
        return 'is writable';
    }

    protected function runMatches(StreamInterface $stream)
    {
        return $stream->isWritable();
    }
}
