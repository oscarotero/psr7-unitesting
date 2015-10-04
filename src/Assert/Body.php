<?php

namespace Psr7Unitesting\Assert;

use PHPUnit_Framework_Assert as Assert;
use Psr\Http\Message\StreamInterface;

/**
 * Class to execute basic assertions with a StreamInterface instance.
 */
class Body extends BaseAssert
{
    /**
     * @var StreamInterface
     */
    protected $body;

    /**
     * @var string
     */
    protected $string;

    /**
     * Constructor.
     *
     * @param StreamInterface $body
     * @param BaseAssert|null $previous
     */
    public function __construct(StreamInterface $body, BaseAssert $previous = null)
    {
        $this->body = $body;
        $this->string = (string) $body;
        $this->previous($previous);
    }

    /**
     * Asserts that the body has a specific size.
     *
     * @param int    $size
     * @param string $message
     *
     * @return self
     */
    public function size($size, $message = '')
    {
        Assert::assertSame($size, $this->body->getSize(), $message);

        return $this;
    }

    /**
     * Asserts that the body is seekable.
     *
     * @param string $message
     *
     * @return self
     */
    public function isSeekable($message = '')
    {
        Assert::assertTrue($this->body->isSeekable(), $message);

        return $this;
    }

    /**
     * Asserts that the body is writable.
     *
     * @param string $message
     *
     * @return self
     */
    public function isWritable($message = '')
    {
        Assert::assertTrue($this->body->isWritable(), $message);

        return $this;
    }

    /**
     * Asserts that the body is readable.
     *
     * @param string $message
     *
     * @return self
     */
    public function isReadable($message = '')
    {
        Assert::assertTrue($this->body->isReadable(), $message);

        return $this;
    }

    /**
     * Asserts that the body contains a string.
     *
     * @param string $string
     * @param string $message
     *
     * @return self
     */
    public function hasString($string, $message = '')
    {
        Assert::assertInternalType('integer', strpos($this->string, $string), $message);

        return $this;
    }

    /**
     * Asserts that the body has not contains a string.
     *
     * @param string $string
     * @param string $message
     *
     * @return self
     */
    public function hasNotString($string, $message = '')
    {
        Assert::assertFalse(strpos($this->string, $string), $message);

        return $this;
    }

    /**
     * Asserts the whole body.
     *
     * @param string $body
     * @param string $message
     *
     * @return self
     */
    public function string($body, $message = '')
    {
        Assert::assertSame($body, $this->string, $message);

        return $this;
    }

    /**
     * Creates an instance of Html to execute assertions with the html code.
     *
     * @return Html
     */
    public function assertHtml()
    {
        return new Html($this->body, $this);
    }
}
