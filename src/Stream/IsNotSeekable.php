<?php

namespace Psr7Unitesting\Stream;

use Psr\Http\Message\StreamInterface;

class IsNotSeekable extends AbstractConstraint
{
    public function toString()
    {
        return 'is not seekable';
    }

    protected function runMatches(StreamInterface $stream)
    {
        return $stream->isSeekable() === false;
    }
}
