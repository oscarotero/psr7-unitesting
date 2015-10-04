<?php

namespace Psr7Unitesting\Assert;

use PHPUnit_Framework_Assert as Assert;
use Psr\Http\Message\MessageInterface;

/**
 * Class to execute assertions for generic http messages.
 */
class Message extends BaseAssert
{
    /**
     * @var MessageInterface
     */
    protected $message;

    /**
     * Constructor.
     *
     * @param MessageInterface $message
     * @param BaseAssert|null  $previous
     */
    public function __construct(MessageInterface $message, BaseAssert $previous = null)
    {
        $this->message = $message;
        $this->previous($previous);
    }

    /**
     * Asserts that a header exists.
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
     * Asserts that a header does not exists.
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
     * Asserts that a header has a specific value.
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
     * Asserts the protocol version of the message.
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
     * Creates a Body instance to execute assertions in the body.
     *
     * @return Body
     */
    public function assertBody()
    {
        return new Body($this->message->getBody(), $this);
    }
}
