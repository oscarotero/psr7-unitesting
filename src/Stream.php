<?php

namespace Psr7Unitesting;

use PHPUnit_Framework_Assert as Assert;
use Psr\Http\Message\StreamInterface;

/**
 * Class to execute basic assertions with a StreamInterface instance.
 */
class Stream extends Utils\AbstractAssert
{
    /**
     * @var StreamInterface
     */
    protected $stream;

    /**
     * @var string
     */
    protected $string;

    /**
     * Constructor.
     *
     * @param StreamInterface     $stream
     * @param AbstractAssert|null $previous
     */
    public function __construct(StreamInterface $stream, Utils\AbstractAssert $previous = null)
    {
        $this->stream = $stream;
        $this->string = (string) $stream;
        $this->previous($previous);
    }

    /**
     * Asserts that the stream has a specific size.
     *
     * @param int    $size
     * @param string $message
     *
     * @return self
     */
    public function size($size, $message = '')
    {
        return $this->assert($this->stream, new Stream\Size($size), $message);
    }

    /**
     * Asserts that the stream is seekable.
     *
     * @param string $message
     *
     * @return self
     */
    public function isSeekable($message = '')
    {
        return $this->assert($this->stream, new Stream\IsSeekable(), $message);
    }

    /**
     * Asserts that the stream is not seekable.
     *
     * @param string $message
     *
     * @return self
     */
    public function isNotSeekable($message = '')
    {
        return $this->assert($this->stream, new Stream\IsNotSeekable(), $message);
    }

    /**
     * Asserts that the stream is writable.
     *
     * @param string $message
     *
     * @return self
     */
    public function isWritable($message = '')
    {
        return $this->assert($this->stream, new Stream\IsWritable(), $message);
    }

    /**
     * Asserts that the stream is not writable.
     *
     * @param string $message
     *
     * @return self
     */
    public function isNotWritable($message = '')
    {
        return $this->assert($this->stream, new Stream\IsNotWritable(), $message);
    }

    /**
     * Asserts that the stream is readable.
     *
     * @param string $message
     *
     * @return self
     */
    public function isReadable($message = '')
    {
        return $this->assert($this->stream, new Stream\IsReadable(), $message);
    }

    /**
     * Asserts that the stream is readable.
     *
     * @param string $message
     *
     * @return self
     */
    public function isNotReadable($message = '')
    {
        return $this->assert($this->stream, new Stream\IsNotReadable(), $message);
    }

    /**
     * Creates an instance of Html to execute assertions with the html code.
     *
     * @return Html
     */
    public function assertHtml()
    {
        return new Html($this->stream, $this);
    }
}
