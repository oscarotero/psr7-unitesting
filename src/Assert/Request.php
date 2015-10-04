<?php

namespace Psr7Unitesting\Assert;

use PHPUnit_Framework_Assert as Assert;
use Psr\Http\Message\RequestInterface;

/**
 * Class to execute assertions in a RequestInstance message.
 */
class Request extends Message
{
    /**
     * @var RequestInterface
     */
    protected $message;

    /**
     * Constructor.
     *
     * @param RequestInterface $message
     * @param BaseAssert|null  $previous
     */
    public function __construct(RequestInterface $message, BaseAssert $previous = null)
    {
        parent::__construct($message, $previous);
    }

    /**
     * Asserts the method of the request.
     *
     * @param string $method
     * @param string $message
     *
     * @return self
     */
    public function method($method, $message = '')
    {
        Assert::assertSame($method, $this->message->getMethod(), $message);

        return $this;
    }

    /**
     * Asserts the request target of the request.
     *
     * @param string $requestTarget
     * @param string $message
     *
     * @return self
     */
    public function requestTarget($requestTarget, $message = '')
    {
        Assert::assertSame($requestTarget, $this->message->getRequestTarget(), $message);

        return $this;
    }

    /**
     * Creates an Uri instance to execute assertions with the UriInterface.
     *
     * @return Uri
     */
    public function assertUri()
    {
        return new Uri($this->message->getUri(), $this);
    }
}
