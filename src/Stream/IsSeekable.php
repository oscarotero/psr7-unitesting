<?php

namespace Psr7Unitesting\Stream;

use Psr\Http\Message\StreamInterface;

class IsSeekable extends AbstractConstraint
{
    public function toString()
    {
        return 'is seekable';
    }

    protected function runMatches(StreamInterface $stream)
    {
        return $stream->isSeekable();
    }
}
