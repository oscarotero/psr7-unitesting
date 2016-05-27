<?php

namespace Psr7Unitesting;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

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
     * @param RequestInterface    $message
     * @param AbstractAssert|null $previous
     */
    public function __construct(RequestInterface $message, Utils\AbstractAssert $previous = null)
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
        return $this->assert($this->message, new Request\Method($method), $message);
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
        return $this->assert($this->message, new Request\RequestTarget($requestTarget), $message);
    }

    /**
     * Asserts the uri value.
     *
     * @param string|UriInterface $uri
     * @param string              $message
     *
     * @return self
     */
    public function uri($uri, $message = '')
    {
        return $this->assert($this->message, new Request\Uri((string) $uri), $message);
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
