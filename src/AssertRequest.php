<?php
namespace Psr7Unitesting;

use PHPUnit_Framework_Assert as Assert;
use Psr\Http\Message\RequestInterface;

/**
 * Class to execute assertions in a RequestInstance message
 */
class AssertRequest extends AssertMessage
{
    /**
     * Constructor
     *
     * @param RequestInterface $message
     */
    public function __construct(RequestInterface $message)
    {
        parent::__construct($message);
    }

    /**
     * Asserts the method of the request
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
     * Asserts the request target of the request
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
     * Asserts the stringified uri
     *
     * @param string $uri
     * @param string $message
     *
     * @return self
     */
    public function uri($uri, $message = '')
    {
        Assert::assertSame((string) $uri, (string) $this->message->getUri(), $message);

        return $this;
    }

    /**
     * Creates an AssertUri instance to execute assertions with the UriInterface
     *
     * @return AssertUri
     */
    public function getUri()
    {
        return new AssertUri($this->message->getUri());
    }
}
