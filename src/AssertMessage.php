<?php
namespace Psr7Unitesting;

use PHPUnit_Framework_Assert as Assert;
use Psr\Http\Message\MessageInterface;

/**
 * Class to execute assertions for generic http messages
 */
class AssertMessage
{
    protected $message;

    /**
     * Constructor
     *
     * @param MessageInterface $message
     */
    public function __construct(MessageInterface $message)
    {
        $this->message = $message;
    }

    /**
     * Asserts that a header exists
     *
     * @param string $name
     * @param string $message
     *
     * @return self
     */
    public function hasHeader($name, $message = '')
    {
        Assert::assertTrue($this->message->hasHeader($name), $message);

        return $this;
    }

    /**
     * Asserts that a header does not exists
     *
     * @param string $name
     * @param string $message
     *
     * @return self
     */
    public function hasNotHeader($name, $message = '')
    {
        Assert::assertFalse($this->message->hasHeader($name), $message);

        return $this;
    }

    /**
     * Asserts that a header has a specific value
     *
     * @param string $name
     * @param string $value
     * @param string $message
     *
     * @return self
     */
    public function hasHeaderWithText($name, $value, $message = '')
    {
        Assert::assertSame($value, $this->message->getHeaderLine($name), $message);

        return $this;
    }

    /**
     * Asserts the protocol version of the message
     *
     * @param string $version
     * @param string $message
     *
     * @return self
     */
    public function protocolVersion($version, $message = '')
    {
        Assert::assertSame($version, $this->message->getProtocolVersion(), $message);

        return $this;
    }

    /**
     * Creates an AssertBody instance to execute assertions in the body
     *
     * @return AssertBody
     */
    public function getBody()
    {
        return new AssertBody($this->message->getBody());
    }
}
