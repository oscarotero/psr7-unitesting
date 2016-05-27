<?php

namespace Psr7Unitesting;

use Psr\Http\Message\MessageInterface;

/**
 * Class to execute assertions for generic http messages.
 */
class Message extends Utils\AbstractAssert
{
    /**
     * @var MessageInterface
     */
    protected $message;

    /**
     * Constructor.
     *
     * @param MessageInterface    $message
     * @param AbstractAssert|null $previous
     */
    public function __construct(MessageInterface $message, Utils\AbstractAssert $previous = null)
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
        return $this->assert($this->message, new Message\HasHeader($name), $message);
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
        return $this->assert($this->message, new Message\HasNotHeader($name), $message);
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
    public function header($name, $value, $message = '')
    {
        return $this->assert($this->message, new Message\Header($name, $value), $message);
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
        return $this->assert($this->message, new Message\ProtocolVersion($version), $message);
    }

    /**
     * Asserts the whole body.
     * 
     * @param string|StreamInterface $body
     * @param string                 $message
     *
     * @return self
     */
    public function body($body, $message = '')
    {
        return $this->assert($this->message, new Message\Body((string) $body), $message);
    }

    /**
     * Creates a Body instance to execute assertions in the body.
     *
     * @return Stream
     */
    public function assertBody()
    {
        return new Stream($this->message->getBody(), $this);
    }
}
