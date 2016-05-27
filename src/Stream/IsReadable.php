<?php

namespace Psr7Unitesting\Stream;

use Psr\Http\Message\StreamInterface;

class IsReadable extends AbstractConstraint
{
    public function toString()
    {
        return 'is readable';
    }

    protected function runMatches(StreamInterface $stream)
    {
        return $stream->isReadable();
    }
}
